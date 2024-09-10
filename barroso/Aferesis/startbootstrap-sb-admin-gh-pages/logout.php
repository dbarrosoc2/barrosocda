<!DOCTYPE html>
<html lang="es">

<head>
  <?php require "head.php"; ?>
  <link rel="stylesheet" href="estilos.css">
</head>

<body>
  <?php 
  session_start();
  session_unset();
  session_destroy();
  header('Refresh: 2; URL = index.php'); 
  ?>
  <?php require "nav.php"; ?>

  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title titulo">LOGOUT Donantes Aferesis</h5>
        <p class="card-text">Cerrando la sesión...</p>
        <a href="./index.php">Inicia sesion</a>
      </div>
    </div>
  </div>
</body>

</html>