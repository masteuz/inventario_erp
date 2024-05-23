<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

$id = $_GET['id'];
$sql = "SELECT * FROM producto WHERE id_producto = $id";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Unidad de Medida</title>
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
    <script defer src="../../assets/datatables/stocks.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group select {
            appearance: none;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
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
    <div class="container">
        <h2>Editar Producto</h2>
        <form action="../../control/producto/editar.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="codigo_barra">Codigo de barras</label>
                <input type="number" id="barras" name="barras" value="<?php echo $row['codigo_barra']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_compra">Precio de Compra</label>
                <input type="number" id="compra" name="compra" value="<?php echo $row['precio_compra']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_venta_minimo">Precio de Venta Minimo</label>
                <input type="number" id="minimo" name="minimo" value="<?php echo $row['precio_venta_minimo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_venta_maximo">Precio de Venta Maximo</label>
                <input type="number" id="maximo" name="maximo" value="<?php echo $row['precio_venta_maximo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="porcentaje_iva">Porcentaje de IVA</label>
                <input type="number" id="iva" name="iva" value="<?php echo $row['porcentaje_iva']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="id_categoria">
                    <?php

                    $sql_categ = $conexion->query("Select * from categoria");

                    while ($resultado_categ = $sql_categ->fetch_assoc()) {

                        $id_categ = $resultado_categ['id_categoria'];
                        $categ = $resultado_categ['descripcion'];

                        if ($id_categ == $row['id_categoria']) { ?>

                            <option value="<?php echo $id_categ ?>" selected><?php echo $categ ?></option>

                        <?php
                        } else { ?>
                            <option value="<?php echo $id_categ ?>"><?php echo $categ ?></option>
                    <?php
                        }
                    }

                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Unidad de medida:</label>
                <select class="form-select" name="id_unidad_medida">
                    <?php

                    $sql_unidad = $conexion->query("Select * from unidad_de_medida");

                    while ($resultado_unidad = $sql_unidad->fetch_assoc()) {

                        $id_unidad = $resultado_unidad['id_unidad_medida'];
                        $unidad = $resultado_unidad['descripcion'];

                        if ($id_unidad == $row['id_unidad_medida']) { ?>

                            <option value="<?php echo $id_unidad ?>" selected><?php echo $unidad ?></option>

                        <?php
                        } else { ?>
                            <option value="<?php echo $id_unidad ?>"><?php echo $unidad ?></option>
                    <?php
                        }
                    }

                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto:</label>
                <input class="form-control" type="file" name="foto"><br>
            </div>
            <div class="form-group">
                <label for="observacion">Observacion</label>
                <input type="text" id="observacion" name="observacion" value="<?php echo $row['observacion']; ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar Cambios</button>
            </div>
            <div class="form-group">
                <a href="listarproducto.php" class="cancelar">Cancelar</a>
            </div>

        </form>

    </div>
</body>

</html>