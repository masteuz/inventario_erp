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
    <script defer src="../../assets/datatables/umedida.js"></script>
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
        <h1 class="ms-3">Unidades de Medida</h1>
        <hr />
    </div>
    <div class="w-75 mt-5 mx-auto">
        <a class="btn btn-secondary mb-3" href="unidadmedida.php">
            <i class='bx bx-plus'></i> Agregar Unidad de Medida
        </a>
        <table id="umedida" class="table table-secondary table-hover">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Abreviatura</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $sql = "SELECT * FROM unidad_de_medida";
                $result = mysqli_query($conexion, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_unidad_medida'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['abreviatura'] . "</td>";
                    echo "<td>
                            <a class='editar' href='editar_unidadmedida.php?id=" . $row['id_unidad_medida'] . "'><i class='bx bx-pencil bx-sm'></i></a>
                          </td>";
                    echo "<td>
                            <a class='eliminar' href='../control/umedida/eliminar.php?id=" . $row['id_unidad_medida'] . "' onclick='return confirmarEliminacion(event)'><i class='bx bx-trash bx-sm'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include("../../assets/footer.php"); ?>
</body>

</html>