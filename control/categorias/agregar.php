<?php
require_once '../../clases/Categoria.php';
require_once '../../clases/Conexion.php';

$descripcion = $_POST['descripcion'];
$estado = $_POST['estado'];

$datos = array($descripcion, $estado);
$obj = new Categoria();
echo $obj->save($datos);
header('location: ../../vista/inventario.php');