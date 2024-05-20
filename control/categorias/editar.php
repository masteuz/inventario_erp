<?php
require_once '../../clases/Categoria.php';
require_once '../../clases/Conexion.php';

$id_categoria = $_POST['id_categoria'];
$descripcion = $_POST['descripcion'];
$estado = $_POST['estado'];

$datos = array($id_categoria, $descripcion, $estado);
$obj = new Categoria();
echo $obj->edit($datos);
header('location: ../../vista/categoria/listarCategoria.php');
