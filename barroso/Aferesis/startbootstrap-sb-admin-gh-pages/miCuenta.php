<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Mi Cuenta";
require_once "./head.php";
require "./Usuarios.php";
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Mi cuenta</h1>
                <?php
                if (isset($_SESSION['usuario'])) {
                    // Obtener los datos de la sesiÃ³n
                    $usuario = $_SESSION['usuario'];
                    //$rol = $_SESSION['rol'];
                    $ip = $_SESSION['ip'];
                    $nombre = $_SESSION['nombre'];
                    $apellidos = $_SESSION['apellidos'];
                    $timeout = $_SESSION['timeout'];
                    ?>

                    <body>
                        <div class="container">
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
                                        <!-- <?php // echo $timeout; ?> -->
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                } else {
                    // Si no hay sesiÃ³n de usuario, mostrar mensaje de error
                    echo "No se ha iniciado sesión.";
                }
                ?>


            </div>
        </main>
        <?php
        require_once "./footer.php";
        ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>