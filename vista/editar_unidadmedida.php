<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

require("../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

$id = $_GET['id'];
$sql = "SELECT * FROM unidad_de_medida WHERE id_unidad_medida = $id";
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
        <h2>Editar Unidad de Medida</h2>
        <form action="../control/umedida/editar.php" method="post">
            <input type="hidden" name="id_unidad_medida" value="<?php echo $row['id_unidad_medida']; ?>">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="abreviatura">Abreviatura</label>
                <input type="text" id="abreviatura" name="abreviatura" value="<?php echo $row['abreviatura']; ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar Cambios</button>
            </div>
            <div class="form-group">
            <a href="lista_unidadmedida.php" class="cancelar">Cancelar</a>
            </div>

        </form>
        <div class="form-group">
            <a href="lista_unidadmedida.php">Cancelar</a>
        </div>
    </div>
</body>

</html>
