<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Lista de Donantes";
require_once "./head.php";
require "./Donantes.php";
?>

<body class="sb-nav-fixed">

    <div id="layoutSidenav_content">
        <main>
            <?php
            require_once "./nav.php";
            require_once "./aside.php";
            ?>
            <div class="container" style="margin-top: 4rem;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Listado de Donantes</h2>
                                <div class="card-body">
                                    <?php
                                    $donante = new Donantes();
                                    echo $donante->listarDonantes(); ?>
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