<?php
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$id = $_POST['id_producto'];
$descripcion = $_POST['descripcion'];
$codigo_barra = $_POST['barras'];
$precio_compra = $_POST['compra'];
$precio_venta_minimo = $_POST['minimo'];
$precio_venta_maximo = $_POST['maximo'];
$porcentaje_iva = $_POST['iva'];
$id_categoria = $_POST['id_categoria'];
$id_unidad_medida = $_POST['id_unidad_medida'];
$foto = $_FILES['foto']['name'];
$observacion = $_POST['observacion'];

$datos = array($id, $descripcion, $codigo_barra, $precio_compra, $precio_venta_minimo, $precio_venta_maximo, $porcentaje_iva, $id_categoria, $id_unidad_medida, $foto, $observacion);
$obj = new Producto();
$resultado = $obj->edit($datos);

if ($resultado && $foto != null) {
    // Subir la imagen al servidor
    $rutaImagen = "../../foto_producto/" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $rutaImagen);

    header('location: ../../vista/producto/listarproducto.php');
} else if ($foto != null) {
    echo "Error al guardar el inmueble";
}

header('location: ../../vista/producto/listarproducto.php');
