<?php
class Usuario
{
    public function login($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        /*$password = mysqli_real_escape_string($conexion,sha1(md5($datos[1])));
			$usuario = mysqli_real_escape_string($conexion,$datos[0]);*/
        $password = $datos[1];
        $login = $datos[0];
        $sql = "SELECT id_usuario, login, password, estado FROM usuario WHERE login='$login' AND password=SHA2('$password', 256) AND estado=1;";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        if ($ver == true) {
            $id = $ver[0];

            $_SESSION['id'] = $id;

            header('location: ../../vista/stock/listarStock.php');
        } else {
            header('location: ../../index.php?el=1');
        }
    }
}
