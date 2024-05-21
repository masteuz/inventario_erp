<?php
require_once '../../clases/Stock.php';
require_once '../../clases/Conexion.php';

$id_stock = $_GET['id_stock'];

$obj = new Stock();
echo $obj->delete($id_stock);
header('location: ../../vista/stock/listarStock.php');
