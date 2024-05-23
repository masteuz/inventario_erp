<?php
require_once '../../clases/Traslado.php';
require_once '../../clases/Conexion.php';
/*
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
header('location: ../../vista/traslado/listarTraslado.php');*/


$fecha = $_POST['fecha'];
$fecha_cierre = $_POST['fecha_cierre'];
$estado = $_POST['estado'];
$id_encargado = $_POST['id_encargado'];
$productos = $_POST['productos'];

$datos = [
    'id_responsable' => $id_encargado,
    'id_deposito_origen' => null, // Se obtiene de cada producto
    'id_deposito_destino' => null, // Se obtiene de cada producto
    'productos' => $productos
];

echo $productos[0]['cantidad'];

$traslado = new Traslado();
$traslado->trasladar($datos);
//header('location: ../../vista/traslado/listarTraslado.php');
