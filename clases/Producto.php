<?php
class Producto
{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $descripcion = $c->test_input($datos[0]);
        $codigo_barra = $c->test_input($datos[1]);
        $precio_compra = $c->test_input($datos[2]);
        $precio_venta_minimo = $c->test_input($datos[3]);
        $precio_venta_maximo = $c->test_input($datos[4]);
        $porcentaje_iva = $c->test_input($datos[5]);
        $id_categoria = $c->test_input($datos[6]);
        $id_unidad_medida = $c->test_input($datos[7]);
        $foto = $c->test_input($datos[8]);
        $observacion = $c->test_input($datos[9]);

        $sql = "INSERT INTO producto (descripcion, codigo_barra, precio_compra, precio_venta_minimo, precio_venta_maximo, porcentaje_iva, id_categoria, id_unidad_medida, foto, observacion) VALUES ('$descripcion', '$codigo_barra', '$precio_compra', '$precio_venta_minimo', '$precio_venta_maximo', '$porcentaje_iva', '$id_categoria', '$id_unidad_medida', '$foto', '$observacion')";
        echo $sql;
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id = $c->test_input($datos[0]);
        $descripcion = $c->test_input($datos[1]);
        $codigo_barra = $c->test_input($datos[2]);
        $precio_compra = $c->test_input($datos[3]);
        $precio_venta_minimo = $c->test_input($datos[4]);
        $precio_venta_maximo = $c->test_input($datos[5]);
        $porcentaje_iva = $c->test_input($datos[6]);
        $id_categoria = $c->test_input($datos[7]);
        $id_unidad_medida = $c->test_input($datos[8]);
        $foto = $c->test_input($datos[9]);
        $observacion = $c->test_input($datos[10]);

        if ($foto == null) {
            $sql = "UPDATE producto SET descripcion='$descripcion', codigo_barra='$codigo_barra', precio_compra='$precio_compra', precio_venta_minimo='$precio_venta_minimo', precio_venta_maximo='$precio_venta_maximo', porcentaje_iva='$porcentaje_iva', id_categoria='$id_categoria', id_unidad_medida='$id_unidad_medida', observacion='$observacion' WHERE id_producto='$id'";
        } else {
            $sql = "UPDATE producto SET descripcion='$descripcion', codigo_barra='$codigo_barra', precio_compra='$precio_compra', precio_venta_minimo='$precio_venta_minimo', precio_venta_maximo='$precio_venta_maximo', porcentaje_iva='$porcentaje_iva', id_categoria='$id_categoria', id_unidad_medida='$id_unidad_medida', foto='$foto', observacion='$observacion' WHERE id_producto='$id'";
        }

        echo $sql;
        $result = mysqli_query($conexion, $sql);
        echo $result;
        return $result;
    }

    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id = $c->test_input($id);
        $sql = "DELETE FROM producto WHERE id_producto='$id'";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
