<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .custom-link-color {
            color: #007bff !important;
        }
    </style>
    <?php
    session_start();
    $title = $_SESSION['nombre'];
    require '../common/head.php';
    require '../common/headerIniciado.php';
    require './Logs.php';
    $logs = new Logger();
    $logs->navegacion($_SESSION['usuario'], $_SERVER['REQUEST_URI'], $_SERVER['REMOTE_ADDR'], "Navegacion a Pagina InfoUser");

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }
    ?>
</head>

<body>
    <div class="container mt-3">
        <h1 class="mb-4">Datos de la Sesión</h1>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Usuario:</strong> <?php echo $_SESSION['usuario']; ?></p>
                <p><strong>IP:</strong> <?php echo $_SESSION['ip']; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre']; ?></p>
                <p><strong>Apellidos:</strong> <?php echo $_SESSION['apellidos']; ?></p>
                <p><strong>Hora de inicio de sesión:</strong> <?php echo $_SESSION['timeout']; ?></p>
            </div>
        </div>
    </div>

    <?php require '../common/footer.php'; ?>
</body>

</html>
