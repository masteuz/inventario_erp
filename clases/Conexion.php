<?php
class Conexion{
    
    public function conectar()
    {
        //Conexión a Base de datos
        $ccn = mysqli_connect("localhost","root","mysql","inventario_erp");
        return $ccn;
    }
    public function test_input($data) {
        $cnn = self::conectar();
        
        $data = mysqli_real_escape_string($cnn,$data);
        //trim — Elimina espacio en blanco del inicio y el final de la cadena
        $data = trim($data);
        ///tripslashes — Quita las barras de un string con comillas escapadas
        $data = stripslashes($data);
        //convierte los caracteres predefinidos "<" y ">" en entidades HTML
        $data = htmlspecialchars($data);
        return $data;
      }
    
}

?>