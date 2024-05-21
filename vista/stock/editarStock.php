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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar stock</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario para editar Categoría</title>
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
            <h2>Editar de Categoría</h2>
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
                    <button type="submit">Agregar Stock</button>
                </div>
            </form>
        </div>
    </body>

    </html>


</body>

</html>