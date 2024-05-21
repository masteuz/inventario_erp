<?php
require_once '../../clases/Medida.php';
require_once '../../clases/Conexion.php';

$id = $_POST['id_unidad_medida'];
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

$datos = array($id, $descripcion, $codigo_barra, $precio_compra, $precio_venta_minimo, $precio_venta_maximo, $porcentaje_iva, $id_categoria, $id_unidad_medida, $foto, $observacion);
$obj = new Producto();
$obj->edit($datos);

header('location: ../../vista/producto/listarproducto.php');
?>
