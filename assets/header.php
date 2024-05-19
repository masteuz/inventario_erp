<div id="preloader" class="preloader"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid" style="padding-left: 25px;">
    <a class="navbar-brand" href="../usuario/admin.php">
      <img src="../../img/logo-topo.png" alt="Logo" width="100px">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-left: 50px;">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../clientes/listarClientes.php"><i class="bx bx-group"></i> Clientes</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-home"></i> Inmuebles
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../inmuebles/listarInmuebles.php">Ver inmuebles</a>
              <a class="dropdown-item" href="../propietarios/listarpropietarios.php">Ver Propietarios</a>
            </div>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <a class="nav-link active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dollar"></i> Finanzas
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../ingresos/listarIngresos.php">Ver ingresos</a>
              <a class="dropdown-item" href="../egresos/listarEgresos.php">Ver egresos</a>
            </div>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <a class="nav-link active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class='bx bx-file'></i> Informes
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../informes/informeIngreso.php">Informe de ingresos</a>
              <a class="dropdown-item" href="../informes/informeEgreso.php">Informe de egresos</a>
              <a class="dropdown-item" href="#">Informe SEPRELAD</a>
            </div>
          </div>
        </li>
      </ul>
      <div class="dropleft" style="padding-right: 100px;">
        <a class="nav-link active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class='bx bxs-user-circle bx-md'></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="../usuario/editPerfil.php">Mi perfil</a>
          <?php
          if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
          ?>
            <a class="dropdown-item" href="../usuario/listarUsuario.php">Usuarios</a>
          <?php
          }
          ?>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <a class="dropdown-item" href="../../control/usuarios/salir.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../assets/js/SWALfunctions.js"></script>

</nav>

<style>
  .bx-dollar,
  .bx-group,
  .bx-home,
  .bxs-user-circle,
  .bx-file {
    color: aqua;
  }
</style>