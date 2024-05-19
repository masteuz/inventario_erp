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

        $categoriaId = $c->test_input($datos[0]);
        $categoriaDesc  = $c->test_input($datos[1]);
        $categoriaValor = $c->test_input($datos[2]);
        $categoriaFecha = $c->test_input($datos[3]);
        $categoriaInm = $c->test_input($datos[4]);

        $sql = "UPDATE categorias set categoria_desc='$categoriaDesc', categoria_valor=$categoriaValor, categoria_fecha='$categoriaFecha', inmuebles_inmueble_id=$categoriaInm where categoria_id=$categoriaId";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function delete($idCategoria)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "delete from categorias where categoria_id = $idCategoria";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
?>