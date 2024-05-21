<?php
require_once '../../clases/Medida.php';
require_once '../../clases/Conexion.php';

$id = $_POST['id_unidad_medida'];
$descripcion = $_POST['descripcion'];
$abreviatura = $_POST['abreviatura'];

$datos = array($id, $descripcion, $abreviatura);
$obj = new Medida();
$obj->edit($datos);

header('location: ../../vista/unidadmedida/lista_unidadmedida.php');
?>
