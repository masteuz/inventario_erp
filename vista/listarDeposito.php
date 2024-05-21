<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit(); // Add exit after header redirection
}

require("../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

function fetchDepositos($conexion) {
    $sql = "SELECT * FROM deposito";
    $result = $conexion->query($sql);

    if ($result === false) {
        throw new Exception('Query failed: ' . $conexion->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

try {
    $depositos = fetchDepositos($conexion);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Depositos</title>
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
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .add-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .add-button a {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-button a:hover {
            background-color: #0056b3;
        }
       
        .action-buttons a {
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .action-buttons a.edit {
            background-color: #28a745;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
        }

        .action-buttons a:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Listado de Depositos</h2>
        <div class="add-button">
            <a href="crearDeposito.php">Agregar Deposito</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Encargado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($depositos as $deposito) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($deposito['id_deposito']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['estado'] == 1 ? 'Activo' : 'Inactivo'); ?></td>
                       
                        <?php $sql = $conexion->query("Select nombre, apellido from funcionario f join persona p on f.id_persona = p.id_persona where id_funcionario =".$deposito['id_encargado']);
                             $result = mysqli_fetch_row($sql);
                             //echo $result;
                        ?>
                        <td><?php echo htmlspecialchars($result[0]." ".$result[1] ); ?></td>
                        
                        <td class="action-buttons">
                            <a href="editarDeposito.php?id=<?php echo $deposito['id_deposito']; ?>" class="edit">Editar</a>
                            <a href="../control/deposito/eliminar.php?id_deposito=<?php echo $deposito['id_deposito']; ?>" class="delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este depósito?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
