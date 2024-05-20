<?php
class Medida
{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $descripcion = $c->test_input($datos[0]);
        $abreviatura = $c->test_input($datos[1]);
        
        $sql = "INSERT INTO unidad_de_medida (descripcion, abreviatura) VALUES ('$descripcion', '$abreviatura')";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id = $c->test_input($datos[0]);
        $descripcion = $c->test_input($datos[1]);
        $abreviatura = $c->test_input($datos[2]);
        
        $sql = "UPDATE unidad_de_medida SET descripcion='$descripcion', abreviatura='$abreviatura' WHERE id_unidad_medida='$id'";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }

    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        
        $id = $c->test_input($id);
        $sql = "DELETE FROM unidad_de_medida WHERE id_unidad_medida='$id'";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
}
?>
