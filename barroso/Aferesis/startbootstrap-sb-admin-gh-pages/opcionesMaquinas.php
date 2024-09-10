<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Mi Cuenta";
require_once "./head.php";
require "./Maquina.php";
$maquina = new Maquinas();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_maquina']) && isset($_POST['boton_presionado'])) {
        $id_maquina = $_POST['id_maquina'];
        $estado_maquina = $_POST['estado_actual'];

        $maquina->actualizarEstadoMaquina($id_maquina, $estado_maquina);
        header('Refresh: 0; URL = opcionesMaquinas.php');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_alta'])) {
        $estado_maquina = $_POST['estado'];
        $descripcion_maquina = $_POST['descripcion'];
        $maquina->altaMaquina($descripcion_maquina, $estado_maquina);
        header('Refresh: 0; URL = opcionesMaquinas.php');
    }
}

?>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <?php
            require_once "./nav.php";
            require_once "./aside.php";
            ?>
            <div class="container" style="margin-top: 3rem;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Listado de Máquinas</h2>
                            </div>
                            <div class="card-body">
                                <?php echo $maquina->listarMaquinas(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="container" style="margin-bottom: 4rem; margin-top: 3rem;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Alta de Máquina</h2>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="mb-3">
                                    <label for="descripcion_maquina" class="form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion_maquina" name="descripcion"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="activa" class="form-label">Estado:</label>
                                    <select class="form-select" id="activa" name="estado">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="form_alta">Alta Máquina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-bottom: 4rem; margin-top: 3rem;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Tiempo de la cita</h2>
                        </div>
                        <div class="card-body">
                            <p>El tiempo actual de la cita es de:</p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nuevo_tiempo" class="form-label">Nuevo Tiempo:</label>
                                    <select class="form-select" id="nuevo_tiempo" name="nuevo_tiempo" required>
                                        <option value="2:00">2 horas</option>
                                        <option value="2:30">2 horas y media</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="form_alta">Definir Duracion de la
                                    cita</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php require_once "./footer.php"; ?>

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

<?php require_once "./footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


</html>