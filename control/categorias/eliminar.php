<?php
require_once '../../clases/Categoria.php';
require_once '../../clases/Conexion.php';

$id_categoria = $_GET['id_categoria'];

$obj = new Categoria();
echo $obj->delete($id_categoria);
header('location: ../../vista/categoria/listarCategoria.php');
