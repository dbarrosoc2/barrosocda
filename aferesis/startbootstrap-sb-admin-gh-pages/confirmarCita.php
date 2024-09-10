<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Confirmar Cita";
require_once "./head.php";
require_once "./Citas.php"; // Asegúrate de incluir el archivo que contiene la clase Citas
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Confirmar Cita</h1>
                <ol class="breadcrumb mb4">
                    <li class="breadcrumb-item active">Seleccionar Paciente</li>
                </ol>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['sends'])) {
                    if (isset($_POST['horaSeleccionada'])) {
                        // Obtener y mostrar el valor de 'horaSeleccionada'
                        $horaSeleccionada = $_POST['horaSeleccionada'];
                        $fecha = $_POST['fecha'];
                        $maquina = $_POST['maquina'];
                        $id_dia = $_POST['idDia'];
                        ?>
                        <h4>La fecha seleccionada fue
                            <?= $fecha ?> y la hora fue
                            <?= $horaSeleccionada ?>
                        </h4>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="buscarPaciente" class="form-label">Buscar Paciente</label>
                                <?php
                                require './Donantes.php';
                                $donantes = new Donantes();
                                // Obtener la lista de pacientes para el select
                                $options = $donantes->listarPacientesParaSelect(' ');

                                // Imprimir el select en tu formulario HTML
                                echo '<select name="paciente">' . $options . '</select>';
                                ?>
                            </div>
                            <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                            <input type="hidden" name="idDia" value="<?php echo htmlspecialchars($id_dia); ?>">
                            <input type="hidden" name="hora" value="<?php echo htmlspecialchars($horaSeleccionada); ?>">
                            <input type="hidden" name="maquina" value="<?php echo htmlspecialchars($maquina); ?>">
                            <input type="submit" name="confirmado" class="btn btn-primary" value="Confirmar">
                        </form>
                        <?php
                    } else {
                        echo "No se ha seleccionado ninguna hora.";
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['confirmado'])) {
                    $cita = new Citas();
                    echo $cita->crearCita($_POST['paciente'], $_POST['idDia'], $_POST['maquina'], "PDT", $_POST['hora']);
                }
                ?>
            </div>
        </main>
        <?php
        require_once "./footer.php";
        ?>
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
    <script>
        function buscarPaciente() {
            var input = document.getElementById('buscarPaciente').value;
            if (input.length >= 3) {
                // Realiza la búsqueda dinámica y muestra los resultados
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("resultadoPacientes").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "buscar_paciente.php?q=" + input, true);
                xmlhttp.send();
            } else {
                // Si la entrada es menor a 3 caracteres, vacía los resultados
                document.getElementById("resultadoPacientes").innerHTML = '';
            }
        }
    </script>

</body>

</html>