<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once './Logs.php';
    session_start();
    $logs = new Logger();
    $logs->navegacion($_SESSION['usuario'], $_SERVER['REQUEST_URI'], $_SERVER['REMOTE_ADDR'], "Navegacion a Pagina Inicio");

    if (!isset($_SESSION['valid'])) {
        header("Location: login.php");
        exit(); // Terminar el script después de redireccionar
    }
    $title = "Inicio";
    require '../common/head.php';
    require '../common/headerIniciado.php';
    require 'conexion.php';

    ?>
</head>
<style>

</style>

<body>
    <?php
    // if (isset($_SESSION['timeout'])) {
    //     echo '<div class="container container-ultima-conexion mt-2"><small class="text-muted small-text">Ultima hora de conexion para el usuario ' . $_SESSION['timeout'] . '</small></div>';
    
    // }
    ?>


    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="cursos.php" class="card-link">
                    <div class="card">
                        <img src="../public/OIG3.2UdBOsVAS9TvomVhU_XG.jpg" class="card-img-top" alt="cursos">
                        <div class="card-body">
                            <h5 class="card-title">Cursos</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php require '../common/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    try {
        // Consulta SQL para actualizar la hora de última conexión del usuario específico
        $consulta = $pdo->prepare("UPDATE personal SET ultima_conexion = NOW() WHERE dni = :dni");
        $consulta->bindParam(':dni', $dni);
        $consulta->execute();
    } catch (PDOException $e) {
        // Manejo de errores en caso de fallo en la conexión o consulta
        echo "Error al cambiar la hora de la ultima conexion: " . $e->getMessage();
    }
    ?>
</body>

</html>