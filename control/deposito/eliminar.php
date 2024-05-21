<?php
require_once '../../clases/Deposito.php';
require_once '../../clases/Conexion.php';

$id_deposito = $_GET['id_deposito'];


    $obj = new Deposito();
    $obj ->delete($id_deposito);
    header('location: ../../vista/listarDeposito.php');

   
  // Add exit after header redirection
