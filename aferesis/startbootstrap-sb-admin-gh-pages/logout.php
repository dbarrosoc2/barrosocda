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

  <?php
  echo '<div class="text-center sin-resultados"><img src="bye.jpg" alt="Sin resultados"></div>';
  header('Refresh: 2; URL = index.php'); ?>
</body>

</html>