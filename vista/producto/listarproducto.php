<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Unidades de Medida</title>
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
    <script defer src="../../assets/datatables/producto.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }


        th {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .actions .editar {
            color: #fff;
            background-color: #28a745;
            border: 1px solid #28a745;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .actions .eliminar {
            color: #fff;
            background-color: #dc3545;
            border: 1px solid #dc3545;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .actions a:hover {
            text-decoration: none;
        }

        .form-group a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .form-group a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    include_once '../../assets/header.php';
    ?>
    <div class="mt-2" style="width: 100%;">
        <h1 class="ms-3">Lista de Productos</h1>
        <hr />
    </div>
    <div class="w-75 mt-5 mx-auto">
        <a class="btn btn-secondary mb-3" href="producto.php">
            <i class='bx bx-plus'></i> Agregar Productos
        </a>
        <table id="producto" class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Codigo barra</th>
                    <th class="text-center">Precio compra</th>
                    <th class="text-center">Precio venta minimo</th>
                    <th class="text-center">Precio venta maximo</th>
                    <th class="text-center">IVA (%)</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Unidad de medida</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Observacion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $sql = "SELECT p.id_producto, p.descripcion, p.codigo_barra, p.precio_compra, p.precio_venta_minimo, p.precio_venta_maximo, p.porcentaje_iva, c.descripcion AS categoria_descripcion, u.descripcion as unidad_descripcion, p.foto, p.observacion
                from producto p
                INNER JOIN categoria c ON c.id_categoria = p.id_categoria
                INNER JOIN unidad_de_medida u ON u.id_unidad_medida = p.id_unidad_medida;";
                $result = mysqli_query($conexion, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_producto'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['codigo_barra'] . "</td>";
                    echo "<td>" . $row['precio_compra'] . "</td>";
                    echo "<td>" . $row['precio_venta_minimo'] . "</td>";
                    echo "<td>" . $row['precio_venta_maximo'] . "</td>";
                    echo "<td>" . $row['porcentaje_iva'] . "</td>";
<<<<<<< HEAD
                    echo "<td>" . $row['id_categoria'] . "</td>";
                    echo "<td>" . $row['id_unidad_medida'] . "</td>";
                    echo "<td><button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#imageModal' onclick='showImage(\"../../foto_producto/" . $row['foto'] . "\")'>VER</button></td>";
=======
                    echo "<td>" . $row['categoria_descripcion'] . "</td>";
                    echo "<td>" . $row['unidad_descripcion'] . "</td>";
                    echo "<td><img src='../../foto_producto/" . $row['foto'] . "' alt='Imagen' width='100px'></td>";
>>>>>>> 966e37e9e4d450b6d6ec4df766a2126bca88cb22
                    echo "<td>" . $row['observacion'] . "</td>";
                    echo "<td class=''>
                            <a class='editar' href='editarproducto.php?id=" . $row['id_producto'] . "'><i class='bx bx-pencil bx-sm'></i></a>
                          </td>";
                    echo "<td class=''>
                            <a class='eliminar' href='../control/producto/eliminar.php?id=" . $row['id_producto'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar este Producto?\");'><i class='bx bx-trash bx-sm'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Imagen del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Imagen del Producto" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <?php include("../../assets/footer.php"); ?>
<script>
    function showImage(src) {
        document.getElementById('modalImage').src = src;
    }
</script>
</body>

</html>