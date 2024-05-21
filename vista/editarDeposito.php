<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit(); // Add exit after header redirection
}

require("../clases/Conexion.php");
$c = new Conexion();
$conexion = $c->conectar();

function getDepositoById($conexion, $id) {
    $sql = "SELECT * FROM deposito WHERE id_deposito = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        throw new Exception('Failed to prepare statement: ' . $conexion->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateDeposito($conexion, $id, $descripcion, $direccion, $telefono, $estado, $id_encargado) {
    $sql = "UPDATE deposito SET descripcion = ?, direccion = ?, telefono = ?, estado = ?, id_encargado = ? WHERE id_deposito = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        throw new Exception('Failed to prepare statement: ' . $conexion->error);
    }
    $stmt->bind_param("sssiii", $descripcion, $direccion, $telefono, $estado, $id_encargado, $id);
    return $stmt->execute();
}

$id = $_GET['id'];

try {
    $deposito = getDepositoById($conexion, $id);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $descripcion = htmlspecialchars(trim($_POST['descripcion']));
        $direccion = htmlspecialchars(trim($_POST['direccion']));
        $telefono = htmlspecialchars(trim($_POST['telefono']));
        $estado = intval($_POST['estado']);
        $id_encargado = intval($_POST['id_encargado']);
        $result = updateDeposito($conexion, $id, $descripcion, $direccion, $telefono, $estado, $id_encargado);
        if ($result) {
            header('Location: listarDeposito.php');
            exit();
        } else {
            echo 'Error al actualizar el deposito.';
        }
    }
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
    <title>Editar Deposito</title>
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
        <h2>Editar Deposito</h2>
        <form action="editarDeposito.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($deposito['descripcion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($deposito['direccion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($deposito['telefono']); ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="1" <?php if ($deposito['estado'] == 1) echo 'selected'; ?>>Activo</option>
                    <option value="0" <?php if ($deposito['estado'] == 0) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_encargado">Encargado</label>
                <input type="number" id="id_encargado" name="id_encargado" value="<?php echo htmlspecialchars($deposito['id_encargado']); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Actualizar Deposito</button>
            </div>
        </form>
    </div>
</body>

</html>
