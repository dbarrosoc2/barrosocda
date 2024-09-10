<?php
include '../common/session-checker.php';

$title = 'Panel de administrador';
$description = 'Resumen de Logs';
$panelAdmin = true;
require_once "../controllers/POO/CLASS/Permisos.php";
$permisos = new Permisos();
$numPermiso = $_SESSION['permiso'];

// Activa la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">

<?php include '../common/head.php'; ?>

<body>

  <?php include '../common/header.php'; ?>

  <?php include '../common/sidebar.php'; ?>

  <main id="main" class="main">
  <?php    
            if ($permisos->verificarPermisosSuper($numPermiso)) {
            echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
            }
        ?>
    <div class="pagetitle">
      <?php include '../common/page-title.php'; ?>

      <section class="section dashboard">
        <?php
        // Asegúrate de que la clase se llama RegistroLogger
        include '../controllers/POO/CLASS/Logs.php'; 
        $logs = new RegistroLogger("../controllers/registroCSVLogin.csv");
        $logs->mostrarRegistros();
        ?>
      </section>
    </div>
  </main>

  <div style="padding-top: 18rem;"></div>
  <?php include '../common/footer.php'; ?>
</body>

</html>