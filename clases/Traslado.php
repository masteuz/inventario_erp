<?php
class Traslado
{
    public function trasladar($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        // Obtener los datos individuales del arreglo
        $fecha = $c->test_input($datos[0]);
        $fecha_cierre = $c->test_input($datos[1]);
        $estado = $c->test_input($datos[2]);
        $id_producto = $c->test_input($datos[3]);
        $cantidad = $c->test_input($datos[4]);
        $id_deposito_origen = $c->test_input($datos[5]);
        $id_deposito_destino = $c->test_input($datos[6]);
        $id_encargado = $c->test_input($datos[7]);

        // Verificar la cantidad disponible en el depósito de origen
        $sql = "SELECT cantidad FROM stock WHERE id_producto = $id_producto AND id_deposito = $id_deposito_origen";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_assoc($result);
        $cantidad_origen = $row['cantidad'];

        if ($cantidad_origen < $cantidad) {
            return "Error: Cantidad insuficiente en el depósito de origen para el producto.";
        }

        // Iniciar la transacción
        mysqli_begin_transaction($conexion);

        try {
            // Registrar el producto en la tabla item_traslado
            $sql = "INSERT INTO item_traslado (id_producto, cantidad) 
                VALUES ($id_producto, $cantidad)";
            $result = mysqli_query($conexion, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conexion));
            }
            $id_item_traslado = mysqli_insert_id($conexion);

            // Registrar el traslado en la tabla traslado con el id del producto trasladado
            $sql = "INSERT INTO traslado (fecha, fecha_cierre, estado, id_responsable, id_deposito_origen, id_deposito_destino, id_item_traslado) 
                VALUES ('$fecha', '$fecha_cierre', '$estado', $id_encargado, $id_deposito_origen, $id_deposito_destino, $id_item_traslado)";
            $result = mysqli_query($conexion, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conexion));
            }

            // Actualizar la cantidad en el depósito de origen
            $sql = "UPDATE stock SET cantidad = cantidad - $cantidad WHERE id_producto = $id_producto AND id_deposito = $id_deposito_origen";
            $result = mysqli_query($conexion, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conexion));
            }

            // Actualizar la cantidad en el depósito de destino (si es necesario)
            $sql = "INSERT INTO stock (id_producto, id_deposito, cantidad, stock_minimo) VALUES ( $id_producto, $id_deposito_destino, $cantidad, $cantidad) 
                        ON DUPLICATE KEY UPDATE cantidad = cantidad + $cantidad";
            $result = mysqli_query($conexion, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conexion));
            }

            // Confirmar la transacción
            mysqli_commit($conexion);

            return "Traslado realizado correctamente.";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            mysqli_rollback($conexion);
            return "Error en el traslado: " . $e->getMessage();
        }
    }
}
