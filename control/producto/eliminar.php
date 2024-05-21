<?php
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$id = $_GET['id'];

$obj = new Producto();
$obj->delete($id);

header('location: ../../vista/producto/listarproducto.php');
?>
