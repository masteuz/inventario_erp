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
    <div class="container">
        <h2>Editar Producto</h2>
        <form action="../control/producto/editar.php" method="post">
            <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="codigo_barra">Codigo de barras</label>
                <input type="number" id="barras" name="barras" value="<?php echo $row['barras']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_compra">Precio de Compra</label>
                <input type="number" id="compra" name="compra" value="<?php echo $row['compra']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_venta_minimo">Precio de Venta Minimo</label>
                <input type="number" id="minimo" name="minimo" value="<?php echo $row['minimo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_venta_maximo">Precio de Venta Maximo</label>
                <input type="number" id="maximo" name="maximo" value="<?php echo $row['maximo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="porcentaje_iva">Porcentaje de IVA</label>
                <input type="number" id="iva" name="iva" value="<?php echo $row['iva']; ?>" required>
            </div>
            <div class="mb-3">
                                <label class="form-label">categoria</label>
                                <select class="form-select" name="categoria">
                                    <option selected disabled>-- Seleccionar categoria --</option>
                                    <?php


                                    $sql = $conexion->query("Select * from categoria");

                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo "<option value='" . $resultado['id_categoria'] . "'>" . $resultado['descripcion'] . " </option>";
                                    }

                                    ?>
                                </select>
             </div>
                <div class="mb-3">
                            <label class="form-label">unidad de medida</label>
                            <select class="form-select" name="id_unidad_medida">
                                <option selected disabled>-- Seleccionar unidad de medida --</option>
                                <?php


                                    $sql = $conexion->query("Select * from unidad_de_medida");

                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo "<option value='" . $resultado['id_unidad_medida'] . "'>" . $resultado['descripcion'] . " </option>";
                                    }

                                    ?>
                                </select>
                            </div>
            <div class="mb-3">
                <label class="form-label">Foto:</label>
                <input class="form-control" type="file" name="imagenInm" required><br>
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
