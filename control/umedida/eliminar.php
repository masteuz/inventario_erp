<?php
require_once '../../clases/Medida.php';
require_once '../../clases/Conexion.php';

$id = $_GET['id'];

$obj = new Medida();
$obj->delete($id);

header('location: ../../vista/lista_unidadmedida.php');
?>
