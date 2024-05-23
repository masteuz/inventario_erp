<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit(); // Add exit after header redirection
}

require("../../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

function fetchDepositos($conexion)
{
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
    <script defer src="../../assets/datatables/deposito.js"></script>
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



        th {
            background-color: #007bff;
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
    <?php
    include_once '../../assets/header.php';
    ?>
    <div class="mt-2" style="width: 100%;">
        <h1 class="ms-3">Depositos</h1>
        <hr />
    </div>
    <div class="w-75 mt-5 mx-auto">
        <a class="btn btn-secondary mb-3" href="crearDeposito.php">
            <i class='bx bx-plus'></i> Agregar Deposito
        </a>
        <table id="deposito" class="table table-secondary table-hover">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Encargado</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php foreach ($depositos as $deposito) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($deposito['id_deposito']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($deposito['estado'] == 1 ? 'Activo' : 'Inactivo'); ?></td>

                        <?php $sql = $conexion->query("Select nombre, apellido from funcionario f join persona p on f.id_persona = p.id_persona where id_funcionario =" . $deposito['id_encargado']);
                        $result = mysqli_fetch_row($sql);
                        //echo $result;
                        ?>
                        <td><?php echo htmlspecialchars($result[0] . " " . $result[1]); ?></td>

                        <td>
                            <a href="editarDeposito.php?id=<?php echo $deposito['id_deposito']; ?>" class="edit"><i class='bx bx-pencil bx-sm'></i></a>
                        </td>
                        <td>
                            <a href="../../control/deposito/eliminar.php?id_deposito=<?php echo $deposito['id_deposito']; ?>" class="delete" onclick="return confirmarEliminacion(event)"><i class='bx bx-trash bx-sm'></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include("../../assets/footer.php"); ?>
</body>

</html>