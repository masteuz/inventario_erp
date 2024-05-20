<?php
class Deposito
{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $descripcion = $c->test_input($datos[0]);
        $direccion = $c->test_input($datos[1]);
        $telefono = $c->test_input($datos[2]);
        $estado  = $c->test_input($datos[3]);
        $id_encargado = $c->test_input($datos[4]);
        //$id = $c->test_input($datos[5]);

        
        
        $sql = "insert into deposito (descripcion,direccion,telefono,estado,id_encargado) values ('$descripcion','$direccion','$telefono',$estado,$id_encargado)";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }


    public function delete($id_deposito)
    {
         $c = new Conexion();
        $conexion = $c->conectar();
        $id_deposito = $c->test_input($id_deposito);

       
        $sql = "delete from deposito where id_deposito = $id_deposito";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
?>