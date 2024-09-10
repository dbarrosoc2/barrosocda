<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$title = "Inicio";
require_once "./acceso.php";
require_once "./head.php";
require_once "./Maquina.php";
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main style="background-image: url('cell.jpg'); background-size: cover; height: 100%;">
            <div class="container-fluid px-4" style="background-color: rgba(255, 255, 255, 0.9);">
                <h1 class="mt-4">Aferesis</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Estadistica</li>
                </ol>

                <!-- Tarjetas de Estadísticas -->
                <div class="row">
                    <?php

                    $acceso = new Acceso();
                    $cantidadDonantes = $acceso->obtenerCantidadDonantes();
                    ?>
                    <!-- Tarjeta 1 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Pacientes Registrados</div>
                                    <h2 class="card-text">
                                        <?php echo $cantidadDonantes; ?>
                                    </h2>
                                </div>
                                <div>
                                    <i class="fa fa-chart-bar fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $cantidadCitasFuturas = $acceso->obtenerCantidadCitasFuturas();
                    ?>
                    <!-- Tarjeta 2 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Citas Pendientes</div>
                                    <h2 class="card-text">
                                        <?= $cantidadCitasFuturas ?>
                                    </h2>
                                </div>
                                <div>
                                    <i class="fa fa-chart-line fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 3 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Maquinas activas</div>
                                    <h2 class="card-text">
                                        <?php
                                        $cantidadMaquinasActivas = $acceso->obtenerCantidadMaquinasActivas();
                                        echo $cantidadMaquinasActivas;
                                        ?>
                                    </h2>
                                </div>
                                <div>
                                    <i class="fa fa-chart-pie fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 4 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-danger text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">Usuarios Registrados</div>
                                    <h2 class="card-text">
                                        <?php
                                        $cantidadUsuariosRegistrados = $acceso->obtenerCantidadUsuariosRegistrados();
                                        echo $cantidadUsuariosRegistrados;
                                        ?>
                                    </h2>
                                </div>
                                <div>
                                    <i class="fa fa-chart-area fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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