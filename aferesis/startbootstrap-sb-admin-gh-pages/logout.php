<?php
session_start();
session_unset();
session_destroy();

// Redirige a la página de inicio
header('Location: ../index.php');
exit();
?>
<!DOCTYPE html>
<html lang="es">
<style>
  .sin-resultados img {
    width: 30rem;
  }
</style>

<head>
  <?php require "head.php"; ?>
  <link rel="stylesheet" href="estilos.css">
</head>

<body>
  <?php require "nav.php"; ?>

  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title titulo">LOGOUT Donantes Aferesis</h5>
        <p class="card-text">Cerrando la sesión...</p>
      </div>
    </div>
  </div>

  <div class="text-center sin-resultados">
    <img src="bye.jpg" alt="Sin resultados">
  </div>
</body>

</html>
