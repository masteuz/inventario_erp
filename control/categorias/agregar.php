<?php
require_once '../../clases/Propietario.php';
require_once '../../clases/Conexion.php';

$nombreProp = $_POST['nombreProp'];
$apellidoProp = $_POST['apellidoProp'];
$telefonoProp = $_POST['telefonoProp'];


$datos = array($nombreProp,$apellidoProp,$telefonoProp);
$obj = new Propietario();
echo $obj->save($datos);
header('location: ../../vista/propietarios/listarpropietarios.php');