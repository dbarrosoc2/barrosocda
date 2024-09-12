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
        exit();
    }
    $title = "Inicio";
    require '../common/head.php';
    require '../common/headerIniciado.php';
    require 'conexion.php';
    ?>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-3">
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
        $consulta = $pdo->prepare("UPDATE personal SET ultima_conexion = NOW() WHERE dni = :dni");
        $consulta->bindParam(':dni', $_SESSION['usuario']);
        $consulta->execute();
    } catch (PDOException $e) {
        echo "Error al cambiar la hora de la ultima conexion: " . $e->getMessage();
    }
    ?>
</body>

</html>