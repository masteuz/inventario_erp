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
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href='assets/stylelogin.css' rel='stylesheet'>
</head>

<body>
  <div class="box">
    <div class="container">

      <form action="control/usuarios/login.php" method="post">

        <div class="input-field">
          <center><input class="input" type="text" id="username" name="username" placeholder="Usuario" required></center>
          <i class="bx bx-user"></i>
        </div>

        <div class="input-field">
          <center><input class="input" type="password" id="password" name="password" placeholder="Contraseña" required></center>
          <i class="bx bx-lock-alt"></i>
        </div>

        <div class="input-field">
          <?php
          if (isset($el)) {
          ?>
            <p style="color: white;"> Usuario o contraseña incorrectos!</p>
          <?php
          }
          ?>
        </div>

        <div class="input-field">
          <center><input class="submit" type="submit" value="Entrar"></center>
        </div>

      </form>
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