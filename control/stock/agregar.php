<?php
require_once '../../clases/Stock.php';
require_once '../../clases/Conexion.php';

$id_producto = $_POST['id_producto'];
$id_deposito = $_POST['id_deposito'];
$cantidad = $_POST['cantidad'];
$stockmin = $_POST['stockmin'];

$datos = array($id_producto, $id_deposito, $cantidad, $stockmin);
$obj = new Stock();
echo $obj->save($datos);
header('location: ../../vista/stock/listarStock.php');
