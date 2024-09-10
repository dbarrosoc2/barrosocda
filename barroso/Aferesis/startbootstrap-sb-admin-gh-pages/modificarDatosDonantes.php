<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Editar donante";
require_once "./head.php";
require "./Donantes.php";
$usuario = new Donantes();
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">
                    <?= $title ?>
                </h1>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['guardar_cambios'])) {
                    // Obtener los datos del formulario
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $apellido1 = $_POST['apellido1'];
                    $apellido2 = $_POST['apellido2'];
                    $nhc = $_POST['nhc'];
                    $telefono = $_POST['telefono'];
                    $dni = $_POST['dni'];
                    $cipa = $_POST['cipa'];
                    $fechaNa = $_POST['fechaNa'];
                    $aceptaComunicaciones = isset($_POST['aceptaComunicaciones']) ? "SI" : "NO";

                    // Crear una instancia de la clase Donantes
                    $donante = new Donantes();

                    // Editar el donante con los datos proporcionados
                    $donante->EditarDonante($id, $nombre, $apellido1, $apellido2, $nhc, $telefono, $dni, $cipa, $fechaNa, $aceptaComunicaciones);

                    // Obtener los datos actualizados del paciente
                    $datos_paciente = $donante->ObtenerDonantePorId($id);
                } elseif (isset($_GET['id'])) {
                    // Obtener el ID del paciente de la URL
                    $id_paciente = $_GET['id'];

                    // Crear una instancia de la clase Donantes
                    $donante = new Donantes();

                    // Obtener los datos del paciente por su ID
                    $datos_paciente = $donante->ObtenerDonantePorId($id_paciente);
                }

                // Verificar si se han obtenido datos del paciente
                if (isset($datos_paciente) && !empty($datos_paciente)) {
                    // Extraer los datos del paciente
                    $nombre = $datos_paciente['nombre'];
                    $apellido1 = $datos_paciente['apellido1'];
                    $apellido2 = $datos_paciente['apellido2'];
                    $nhc = $datos_paciente['nhc'];
                    $telefono = $datos_paciente['telef1'];
                    $dni = $datos_paciente['dni'];
                    $cipa = $datos_paciente['cipa'];
                    $fechaNa = $datos_paciente['fecha_nacimiento'];
                    $aceptaComunicaciones = $datos_paciente['acepto_comunicacion'];
                } else {
                    // Si no se obtienen datos del paciente, mostrar un mensaje de error o redirigir a una página de error
                    //echo "No se encontraron datos del paciente.";
                }
                ?>

                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">
                                Complete o edite los datos
                            </h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id_paciente; ?>">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $nombre; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="apellido1" class="form-label">Primer Apellido:</label>
                                            <input type="text" class="form-control" id="apellido1" name="apellido1"
                                                value="<?php echo $apellido1; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                value="<?php echo $apellido2; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nhc" class="form-label">NHC:</label>
                                            <input type="text" class="form-control" id="nhc" name="nhc"
                                                value="<?php echo $nhc; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Teléfono:</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                value="<?php echo $telefono; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="dni" class="form-label">DNI:</label>
                                            <input type="text" class="form-control" id="dni" name="dni"
                                                value="<?php echo $dni; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="cipa" class="form-label">CIPA:</label>
                                            <input type="text" class="form-control" id="cipa" name="cipa"
                                                value="<?php echo $cipa; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fechaNa" class="form-label">Fecha de Nacimiento:</label>
                                            <input type="date" class="form-control" id="fechaNa" name="fechaNa"
                                                value="<?php echo $fechaNa; ?>">
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="aceptaComunicaciones"
                                                name="aceptaComunicaciones" <?php if ($aceptaComunicaciones)
                                                    echo "checked"; ?>>
                                            <label class="form-check-label" for="aceptaComunicaciones">Acepta
                                                comunicaciones</label>
                                        </div>

                                        <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar
                                            cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                    <?php
                    require_once "./footer.php";
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