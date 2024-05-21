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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Deposito</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Ingreso de Deposito</title>
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
        <div class="container">
            <h2>Ingreso de Deposito</h2>
            <form action="../../control/deposito/agregar.php" method="post">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                          <label class="form-label">Encargado:</label>
                                <select class="form-select" name="id_encargado">
                                    <option selected disabled>-- Seleccionar tipo --</option>
                                    <?php


                                    $sql = $conexion->query("Select id_funcionario, nombre, apellido from funcionario f join persona p on f.id_persona = p.id_persona");
                                   
                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo "<option value='" . $resultado['id_funcionario'] . "'>".$resultado['nombre']." ".$resultado['apellido']."</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                <div class="form-group">
                <div class="form-group">
                    <button type="submit">Agregar Deposito</button>
                </div>
            </form>
        </div>
    </body>

    </html>


</body>

</html>