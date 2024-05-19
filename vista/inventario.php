<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

require("../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
</head>

<body>

<h1>Inventario</h1>

</body>
</html>