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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso de Categoría</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <script defer src="../../assets/datatables/categorias.js"></script>


    <title>Crear categoria</title>
</head>

<body>

    <?php
    include_once '../../assets/header.php';
    ?>

    <div class="mt-2" style="width: 100%;">
        <h1 class="ms-3">Categorias</h1>
        <hr />
    </div>

    <div class="w-75 mt-5 mx-auto">
        <table id="categorias" class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                    <th><a href="crearCategoria.php">
                            Agregar
                        </a></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php

                $sql = $conexion->query("SELECT id_categoria, descripcion, estado FROM categoria");

                while ($resultado = $sql->fetch_assoc()) {
                ?>

                    <tr>
                        <td><?php echo $resultado['id_categoria'] ?></td>
                        <td><?php echo $resultado['descripcion'] ?></td>
                        <td><?php echo htmlspecialchars($resultado['estado'] == 1 ? 'Activo' : 'Inactivo'); ?></td>
                        <td>
                            <a href="editarCategoria.php?id_categoria=<?php echo $resultado['id_categoria'] ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <a href="../../control/categorias/eliminar.php?id_categoria=<?php echo $resultado['id_categoria'] ?>" onclick="return confirmarEliminacion(event)">
                                Eliminar
                            </a>
                        </td>
                    </tr>

                <?php

                }

                ?>
            </tbody>
        </table>
        <br>
    </div>
</body>

</html>