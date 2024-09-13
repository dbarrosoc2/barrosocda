<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<style>
    .custom-link-color {
        color: #007bff !important;
        /* Un ejemplo con azul, pero puedes cambiarlo por el color que prefieras */
    }
</style>
<?php

$title = $_SESSION['nombre'];
require '../common/head.php';
require '../common/headerIniciado.php';
require './Logs.php';
$logs = new Logger();
$logs->navegacion($_SESSION['usuario'], $_SERVER['REQUEST_URI'], $_SERVER['REMOTE_ADDR'], "Navegacion a Pagina InfoUser");

if (isset($_SESSION['usuario'])) {
    // Obtener los datos de la sesión
    $usuario = $_SESSION['usuario'];
    //$rol = $_SESSION['rol'];
    $ip = $_SESSION['ip'];
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
    $timeout = $_SESSION['timeout'];
    ?>

    <body>
        <div class="container">
            <h1>Datos de la Sesión</h1>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Usuario:</strong>
                        <?php echo $usuario; ?>
                    </p>
                    <p><strong>Rol:</strong>
                        <?php //echo $rol; ?>
                    </p>
                    <p><strong>IP:</strong>
                        <?php echo $ip; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nombre:</strong>
                        <?php echo $nombre; ?>
                    </p>
                    <p><strong>Apellidos:</strong>
                        <?php echo $apellidos; ?>
                    </p>
                    <p><strong>Hora de inicio de sesión:</strong>
                        <?php echo $timeout; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
} else {
    // Si no hay sesión de usuario, mostrar mensaje de error
    echo "No se ha iniciado sesión.";
}
?>




    <?php require '../common/footer.php'; ?>
</body>

</html>