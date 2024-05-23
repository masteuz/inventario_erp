<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../index.php');
}


$id_stock = $_GET['id_stock'];

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();
$sql = $conexion->query("select * from stock where id_stock=$id_stock");

while ($resultado = $sql->fetch_assoc()) {
    $id_stock = $resultado['id_stock'];
    $id_producto = $resultado['id_producto'];
    $id_deposito = $resultado['id_deposito'];
    $cantidad = $resultado['cantidad'];
    $stockmin = $resultado['stock_minimo'];
}
?>

<body>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario para editar Stock</title>
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
        </style>
    </head>

    <body>
        <?php
        include_once '../../assets/header.php';
        ?>
        </div>
        <div class="container">
            <h2>Editar de Stock</h2>
            <form action="../../control/stock/editar.php" method="post">

                <input type="hidden" name="id_stock" value="<?php echo $id_stock ?>">

                <div class="mb-3">
                    <label class="form-label text-light">Producto:</label>
                    <select class="form-select" name="id_producto">
                        <?php

                        $sql_prod = $conexion->query("Select * from producto");

                        while ($resultado_prod = $sql_prod->fetch_assoc()) {

                            $id_prod = $resultado_prod['id_producto'];
                            $dep = $resultado_prod['descripcion'];

                            if ($id_prod == $id_producto) { ?>

                                <option value="<?php echo $id_prod ?>" selected><?php echo $dep ?></option>

                            <?php
                            } else { ?>
                                <option value="<?php echo $id_prod ?>"><?php echo $dep ?></option>
                        <?php
                            }
                        }

                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Deposito:</label>
                    <select class="form-select" name="id_deposito">
                        <?php

                        $sql_depo = $conexion->query("Select * from deposito");

                        while ($resultado_depo = $sql_depo->fetch_assoc()) {

                            $id_depo = $resultado_depo['id_deposito'];
                            $depo = $resultado_depo['descripcion'];

                            if ($id_depo == $id_deposito) { ?>

                                <option value="<?php echo $id_depo ?>" selected><?php echo $depo ?></option>

                            <?php
                            } else { ?>
                                <option value="<?php echo $id_depo ?>"><?php echo $depo ?></option>
                        <?php
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="text" id="cantidad" name="cantidad" value="<?php echo $cantidad ?>" required>
                </div>
                <div class="form-group">
                    <label for="stockmin">Stock Minimo</label>
                    <input type="text" id="stockmin" name="stockmin" value="<?php echo $stockmin ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit">Actualizar Stock</button>
                </div>
            </form>
        </div>
    </body>

    </html>