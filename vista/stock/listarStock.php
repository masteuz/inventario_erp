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
    <script defer src="../../assets/datatables/stock.js"></script>


    <title>Crear stock</title>
</head>

<body>

    <?php
    include_once '../../assets/header.php';
    ?>

    <div class="mt-2" style="width: 100%;">
        <h1 class="ms-3">Stock</h1>
        <hr />
    </div>

    <div class="w-75 mt-5 mx-auto">
        <a class="btn btn-secondary mb-3" href="agregarStock.php">
            <i class='bx bx-plus'></i> Agregar Productos al Stock
        </a>
        <table id="stock" class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Deposito</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Stock minimo</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php

                $sql = $conexion->query("SELECT stock.id_stock, p.descripcion AS producto_descripcion, d.descripcion AS deposito_descripcion, stock.cantidad, stock.stock_minimo 
                                        FROM stock
                                        INNER JOIN producto p ON p.id_producto = stock.id_producto
                                        INNER JOIN deposito d ON d.id_deposito = stock.id_deposito;");

                while ($resultado = $sql->fetch_assoc()) {
                ?>

                    <tr>
                        <td><?php echo $resultado['id_stock'] ?></td>
                        <td><?php echo $resultado['producto_descripcion'] ?></td>
                        <td><?php echo $resultado['deposito_descripcion'] ?></td>
                        <td><?php echo $resultado['cantidad'] ?></td>
                        <td><?php echo $resultado['stock_minimo'] ?></td>
                        <td>
                            <a href="editarStock.php?id_stock=<?php echo $resultado['id_stock'] ?>">
                                <i class='bx bx-pencil bx-sm'></i>
                            </a>
                        </td>
                        <td>
                            <a href="../../control/stock/eliminar.php?id_stock=<?php echo $resultado['id_stock'] ?>" onclick="return confirmarEliminacion(event)">
                                <i class='bx bx-trash bx-sm'></i>
                            </a>
                        </td>
                    </tr>

                <?php

                }

                ?>
            </tbody>
        </table>
        <br>
    </div>
</body>

</html>