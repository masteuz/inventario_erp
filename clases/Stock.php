<?php
class Stock
{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $id_producto = $c->test_input($datos[0]);
        $id_deposito  = $c->test_input($datos[1]);
        $cantidad  = $c->test_input($datos[2]);
        $stockmin  = $c->test_input($datos[3]);

        $sql = "insert into stock (id_producto, id_deposito, cantidad, stock_minimo) values ($id_producto, $id_deposito, $cantidad, $stockmin)";
        echo $sql;
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id_stock = $c->test_input($datos[0]);
        $id_producto = $c->test_input($datos[1]);
        $id_deposito  = $c->test_input($datos[2]);
        $cantidad  = $c->test_input($datos[3]);
        $stockmin  = $c->test_input($datos[4]);

        $sql = "UPDATE stock set id_producto=$id_producto, id_deposito=$id_deposito, cantidad=$cantidad, stock_minimo=$stockmin  where id_stock=$id_stock";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function delete($id_stock)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "delete from stock where id_stock = $id_stock";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
