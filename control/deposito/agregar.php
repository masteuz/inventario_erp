<?php
require_once '../../clases/Deposito.php';
require_once '../../clases/Conexion.php';

session_start();


if (!isset($_SESSION['id'])) {
    //echo 'hola';
    $obj = new Deposito();
    $obj ->delete($id);
    header('location: ../../vista/listarDeposito.php');

   
  // Add exit after header redirection
}else{
//$id = $_POST['descripcion'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$estado = $_POST['estado'];
$id_encargado = $_POST['id_encargado'];
//$id = $_POST['id_deposito'];

$datos = array($descripcion,$direccion,$telefono,$estado,$id_encargado);
$obj = new Deposito();
echo $obj->save($datos);
header('location: ../../vista/listarDeposito.php');

}
