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

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
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
    <div class="container">
        <h2>Lista de Unidades de Medida</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Abreviatura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM unidad_de_medida";
                $result = mysqli_query($conexion, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_unidad_medida'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['abreviatura'] . "</td>";
                    echo "<td class='actions'>
                            <a class='editar' href='editar_unidadmedida.php?id=" . $row['id_unidad_medida'] . "'>Editar</a>
                            <a class='eliminar' href='../control/umedida/eliminar.php?id=" . $row['id_unidad_medida'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar esta unidad de medida?\");'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="form-group">
            <a href="unidadmedida.php">Volver a Ingreso de Unidad de Medida</a>
        </div>
    </div>
</body>

</html>
