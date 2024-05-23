<?php

session_start();

if (isset($_SESSION['id'])) {
  header('location: vista/stock/listarStock.php');
}

if (isset($_GET['el'])) {
  $el = $_GET['el'];
};

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="assets/stylelogin.css">
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <h1>SOFTWARE DE GESTION INTEGRADA</h1>
      <h2>MODULO DE INVENTARIO</h2>
      <form action="control/usuarios/login.php" method="post">
        <div class="error-message">
          <?php if (isset($el)) { ?>
            <p>Usuario o contraseña incorrectos!</p>
          <?php } ?>
        </div>
        <div class="input-field">
          <i class="bx bx-user"></i>
          <input type="text" id="username" name="username" placeholder="Usuario" required>
        </div>
        <div class="input-field">
          <i class="bx bx-lock-alt"></i>
          <input type="password" id="password" name="password" placeholder="Contraseña" required>
        </div>
        <div class="input-field sub">
          <input class="submit-btn" type="submit" value="Entrar">
        </div>
      </form>
    </div>
  </div>
</body>

</html>

<script>
  if (window.history.replaceState) {
    var cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.replaceState({
      path: cleanUrl
    }, '', cleanUrl);
  }
</script>