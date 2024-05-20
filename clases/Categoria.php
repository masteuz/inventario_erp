<?php
class Categoria
{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $descripcion = $c->test_input($datos[0]);
        $estado  = $c->test_input($datos[1]);

        $sql = "insert into categoria (descripcion, estado) values ('$descripcion', $estado)";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id_categoria = $c->test_input($datos[0]);
        $descripcion  = $c->test_input($datos[1]);
        $estado = $c->test_input($datos[2]);

        $sql = "UPDATE categoria set descripcion='$descripcion', estado=$estado where id_categoria=$id_categoria";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function delete($id_categoria)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "delete from categoria where id_categoria = $id_categoria";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
