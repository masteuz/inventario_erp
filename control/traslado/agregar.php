<?php
require_once '../../clases/Traslado.php';
require_once '../../clases/Conexion.php';

$fecha = $_POST['fecha'];
$fecha_cierre = $_POST['fecha_cierre'];
$estado = $_POST['estado'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$id_deposito_origen = $_POST['id_deposito_origen'];
$id_deposito_destino = $_POST['id_deposito_destino'];
$id_encargado = $_POST['id_encargado'];



$datos = array($fecha, $fecha_cierre, $estado, $id_producto, $cantidad, $id_deposito_origen, $id_deposito_destino, $id_encargado);
$obj = new Traslado();
echo $obj->trasladar($datos);
header('location: ../../vista/traslado/listarTraslado.php');
