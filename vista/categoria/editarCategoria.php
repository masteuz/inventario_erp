<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../index.php');
}


$id_categoria = $_GET['id_categoria'];

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();
$sql = $conexion->query("select * from categoria where id_categoria=$id_categoria");

while ($resultado = $sql->fetch_assoc()) {
    $id_categoria = $resultado['id_categoria'];
    $descripcion = $resultado['descripcion'];
    $estado = $resultado['estado'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar categoria</title>
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
            <form action="../../control/categorias/editar.php" method="post">

                <input type="hidden" name="id_categoria" value="<?php echo $id_categoria ?>">

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion ?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="1" <?php if ($estado == 1) echo 'selected'; ?>>Activo</option>
                        <option value="0" <?php if ($estado == 0) echo 'selected'; ?>>Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Editar Categoría</button>
                </div>
            </form>
        </div>
    </body>

    </html>


</body>

</html>