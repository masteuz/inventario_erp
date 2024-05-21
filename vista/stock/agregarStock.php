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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar Stock</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Ingreso de Stock</title>
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
        </div>
        <div class="container">
            <h2>Ingreso de Stock</h2>
            <form action="../../control/stock/agregar.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Producto:</label>
                    <select class="form-select" name="id_producto">
                        <option selected disabled>-- Seleccionar producto --</option>
                        <?php


                        $sql = $conexion->query("Select * from producto");

                        while ($resultado = $sql->fetch_assoc()) {
                            echo "<option value='" . $resultado['id_producto'] . "'>" . $resultado['descripcion'] . " </option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deposito:</label>
                    <select class="form-select" name="id_deposito">
                        <option selected disabled>-- Seleccionar deposito --</option>
                        <?php


                        $sql = $conexion->query("Select * from deposito");

                        while ($resultado = $sql->fetch_assoc()) {
                            echo "<option value='" . $resultado['id_deposito'] . "'>" . $resultado['descripcion'] . " </option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="text" id="cantidad" name="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="stockmin">Stock Minimo</label>
                    <input type="text" id="stockmin" name="stockmin" required>
                </div>
                <div class="form-group">
                    <button type="submit">Agregar Stock</button>
                </div>
            </form>
        </div>
    </body>

    </html>


</body>

</html>