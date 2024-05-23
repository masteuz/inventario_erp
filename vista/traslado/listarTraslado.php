<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../index.php');
}

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso de Categoría</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../assets/style1.css">


    <script defer src="../../assets/js/bootstrap.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="../../assets/js/SWALfunctions.js"></script>
    <script defer src="../../assets/datatables/traslado.js"></script>


    <title>Crear stock</title>
</head>

<body>

    <?php
    include_once '../../assets/header.php';
    ?>

    <div class="mt-2" style="width: 100%;">
        <h1 class="ms-3">Traslados</h1>
        <hr />
    </div>

    <div class="w-75 mt-5 mx-auto">

        <a class="btn btn-secondary mb-3" href="realizarTraslado.php">
            <i class='bx bx-transfer-alt'></i> Trasladar producto
        </a>
        <table id="traslado" class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Deposito Origen</th>
                    <th class="text-center">Deposito Destino</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php

                $sql = $conexion->query("select t.id_traslado AS id_traslado, t.fecha as traslado_fecha, p.descripcion as producto_descripcion, it.cantidad as item_traslado_cantidad, depo.descripcion AS deposito_origen_descripcion, depd.descripcion AS deposito_destino_descripcion     
                from traslado as t   
                join item_traslado as it   on t.id_item_traslado=it.id_traslado   
                join producto as p on it.id_producto=p.id_producto
                JOIN deposito as depo ON depo.id_deposito = t.id_deposito_origen
                JOIN deposito as depd ON depd.id_deposito = t.id_deposito_destino;");

                while ($resultado = $sql->fetch_assoc()) {
                ?>

                    <tr>
                        <td><?php echo $resultado['id_traslado'] ?></td>
                        <td><?php echo $resultado['traslado_fecha'] ?></td>
                        <td><?php echo $resultado['producto_descripcion'] ?></td>
                        <td><?php echo $resultado['item_traslado_cantidad'] ?></td>
                        <td><?php echo $resultado['deposito_origen_descripcion'] ?></td>
                        <td><?php echo $resultado['deposito_destino_descripcion'] ?></td>
                    </tr>

                <?php

                }

                ?>
            </tbody>
        </table>
        <br>
    </div>
    <?php include("../../assets/footer.php"); ?>
</body>

</html>