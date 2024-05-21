<?php
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$descripcion = $_POST['descripcion'];
$codigo_barra = $_POST['barras'];
$precio_compra = $_POST['compra'];
$precio_venta_minimo = $_POST['minimo'];
$precio_venta_maximo = $_POST['maximo'];
$porcentaje_iva = $_POST['iva'];
$id_categoria = $_POST['categoria'];
$id_unidad_medida = $_POST['id_unidad_medida'];
$foto = $_POST['foto'];
$observacion = $_POST['observacion'];

$datos = array($descripcion, $codigo_barra, $precio_compra, $precio_venta_minimo, $precio_venta_maximo, $porcentaje_iva, $id_categoria, $id_unidad_medida, $foto, $observacion);
$obj = new Producto();
$obj->save($datos);

header('location: ../../vista/producto/listarproducto.php');
?>
