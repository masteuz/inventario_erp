<?php
require_once '../../clases/Medida.php';
require_once '../../clases/Conexion.php';

$descripcion = $_POST['descripcion'];
$abreviatura = $_POST['abreviatura'];

$datos = array($descripcion, $abreviatura);
$obj = new Medida();
$obj->save($datos);

header('location: ../../vista/unidadmedida/lista_unidadmedida.php');
?>
