<?php
class Traslado
{
    public function trasladar($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        // Obtener y sanitizar los datos
        $id_responsable = $c->test_input($datos['id_responsable']);
        $id_deposito_origen = $c->test_input($datos['id_deposito_origen']);
        $id_deposito_destino = $c->test_input($datos['id_deposito_destino']);
        $productos = $datos['productos']; // Arreglo de productos a trasladar

        // Iniciar la transacción
        $conexion->begin_transaction();

        try {
            // Crear un nuevo registro en la tabla traslado
            $sql = "INSERT INTO traslado (fecha, estado, id_responsable, id_deposito_origen, id_deposito_destino) 
            VALUES (NOW(), 'pendiente', ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
            }
            $stmt->bind_param("iii", $id_responsable, $id_deposito_origen, $id_deposito_destino);
            $stmt->execute();
            $id_traslado = $stmt->insert_id;
            $stmt->close();

            echo "id deposito origen $id_deposito_origen";
            // Iterar sobre los productos para registrar en item_traslado y actualizar stock
            foreach ($productos as $producto) {

                $id_producto = $c->test_input($producto['id_producto']);
                $cantidad = $c->test_input($producto['cantidad']);
                $id_deposito_origen = $producto['id_deposito_origen'];
                $id_deposito_destino = $producto['id_deposito_destino'];

                // Verificar la cantidad disponible en el depósito de origen
                $sql = "SELECT cantidad FROM stock WHERE id_producto = ? AND id_deposito = ?";
                $stmt = $conexion->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
                }
                $stmt->bind_param("ii", $id_producto, $id_deposito_origen);
                $stmt->execute();
                $stmt->bind_result($cantidad_origen);
                $stmt->fetch();
                $stmt->close();

                // Depuración: Mostrar cantidad origen y cantidad solicitada
                echo "Cantidad en depósito de origen para producto ID $id_producto: $cantidad_origen<br>";
                echo "Cantidad solicitada: $cantidad<br>";

                if ($cantidad_origen < $cantidad) {
                    throw new Exception("Cantidad insuficiente en el depósito de origen para el producto ID $id_producto.");
                }

                // Restar la cantidad del depósito de origen
                $sql = "UPDATE stock SET cantidad = cantidad - ? WHERE id_producto = ? AND id_deposito = ?";
                $stmt = $conexion->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
                }
                $stmt->bind_param("iii", $cantidad, $id_producto, $id_deposito_origen);
                $stmt->execute();
                $stmt->close();

                // Sumar la cantidad al depósito de destino
                $sql = "INSERT INTO stock (id_producto, id_deposito, cantidad) VALUES (?, ?, ?) 
                        ON DUPLICATE KEY UPDATE cantidad = cantidad + ?";
                $stmt = $conexion->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
                }
                $stmt->bind_param("iiii", $id_producto, $id_deposito_destino, $cantidad, $cantidad);
                $stmt->execute();
                $stmt->close();

                // Registrar el traslado en item_traslado
                $sql = "INSERT INTO item_traslado (id_traslado, id_producto, cantidad) VALUES (?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
                }
                $stmt->bind_param("iii", $id_traslado, $id_producto, $cantidad);
                $stmt->execute();
                $stmt->close();
            }

            // Confirmar la transacción
            $conexion->commit();

            echo "Traslado realizado con éxito.";
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            echo "Error en el traslado: " . $e->getMessage();
            return false;
        }

        // Cerrar la conexión
        $conexion->close();
    }
}
