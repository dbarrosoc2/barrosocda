<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Seleccion de Horario";
require_once "./head.php";
?>
<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #C5CAE9 !important;
        background-repeat: no-repeat;
        padding: 0px !important;
    }

    .container-fluid {
        padding-top: 120px !important;
        padding-bottom: 120px !important;
    }

    .card {
        box-shadow: 0px 4px 8px 0px #7986CB;
    }

    input {
        padding: 10px 20px !important;
        border: 1px solid #000 !important;
        border-radius: 10px;
        box-sizing: border-box;
        background-color: #616161 !important;
        color: #fff !important;
        font-size: 16px;
        letter-spacing: 1px;
        width: 180px;
    }

    input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #512DA8;
        outline-width: 0;
    }

    ::placeholder {
        color: #fff;
        opacity: 1;
    }

    :-ms-input-placeholder {
        color: #fff;
    }

    ::-ms-input-placeholder {
        color: #fff;
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }

    .datepicker {
        background-color: #000 !important;
        color: #fff !important;
        border: none;
        padding: 10px !important;
    }

    .datepicker-dropdown:after {
        border-bottom: 6px solid #000;
    }

    thead tr:nth-child(3) th {
        color: #fff !important;
        font-weight: bold;
        padding-top: 20px;
        padding-bottom: 10px;
    }

    .dow,
    .old-day,
    .day,
    .new-day {
        width: 40px !important;
        height: 40px !important;
        border-radius: 0px !important;
    }

    .old-day:hover,
    .day:hover,
    .new-day:hover,
    .month:hover,
    .year:hover,
    .decade:hover,
    .century:hover {
        border-radius: 6px !important;
        background-color: #eee;
        color: #000;
    }

    .active {
        border-radius: 6px !important;
        background-image: linear-gradient(#90CAF9, #64B5F6) !important;
        color: #000 !important;
    }

    .disabled {
        color: #616161 !important;
    }

    .prev,
    .next,
    .datepicker-switch {
        border-radius: 0 !important;
        padding: 20px 10px !important;
        text-transform: uppercase;
        font-size: 20px;
        color: #fff !important;
        opacity: 0.8;
    }

    .prev:hover,
    .next:hover,
    .datepicker-switch:hover {
        background-color: inherit !important;
        opacity: 1;
    }

    .cell {
        border: 1px solid #BDBDBD;
        margin: 2px;
        cursor: pointer;
    }

    .cell:hover {
        border: 1px solid #3D5AFE;
    }

    .cell.select {
        background-color: #3D5AFE;
        color: #fff;
    }

    .fa-calendar {
        color: #fff;
        font-size: 30px;
        padding-top: 8px;
        padding-left: 5px;
        cursor: pointer;
    }
</style>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div class="container-fluid px-0 px-sm-4 mx-auto">
        <div class="row justify-content-center mx-0">
            <div class="col-lg-10">
                <div class="card border-0">
                    <form autocomplete="off" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="card-header bg-dark">
                            <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
                                <input type="text" id="dp1" class="datepicker" placeholder="Escoge una fecha"
                                    name="date" readonly><span class="fa fa-calendar"></span>
                                <input type="submit" value="Enviar" name="diaSeleccionado">
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET['diaSeleccionado'])) {
                        $fechaOldForm = $_GET['date'];
                        $fecha = DateTime::createFromFormat('d-m-Y', $fechaOldForm)->format('Y-m-d');
                        require 'conexion.php';
                        try {
                            // Suponiendo que $fecha contiene la fecha que deseas consultar
                            $query = "SELECT descripcion_dia, hora_inicio, hora_fin, id_dia
                                      FROM calendario                
                                      WHERE fecha = :fecha";

                            // Preparar la consulta
                            $statement = $pdo->prepare($query);

                            // Asignar el valor de $fecha al parámetro de la consulta
                            $statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);

                            // Ejecutar la consulta
                            $statement->execute();

                            // Obtener el resultado
                            $fila = $statement->fetch(PDO::FETCH_ASSOC);

                            // Verificar si hay resultado
                            if ($fila) {
                                // Acceder a los datos
                                $descripcionDia = $fila['descripcion_dia'];
                                $horaInicio = $fila['hora_inicio'];
                                $horaFin = $fila['hora_fin'];
                                $idDia = $fila['id_dia'];
                            } else {
                                echo "No hay horarios disponibles para la fecha seleccionada.";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }

                        // Verificar si $horaInicio y $horaFin están definidos antes de continuar
                        if ($horaInicio && $horaFin) {

                            try {
                                require './conexion.php';
                                // Preparar la consulta SQL para contar el número de máquinas activas
                                $queryMaquina = "SELECT COUNT(activa) FROM maquina WHERE activa = 'SI'";
                                // Preparar la consulta
                                $stmt = $pdo->prepare($queryMaquina);
                                // Ejecutar la consulta
                                $stmt->execute();
                                // Obtener el número de máquinas activas
                                $numeroMaquinasActivas = $stmt->fetchColumn();
                                // Si hay al menos una máquina activa, generar el formulario para cada máquina
                                if ($numeroMaquinasActivas > 0) {
                                    ?>
                                    <div class="text-center">
                                        <h3 class="mt-4">El número de máquinas disponibles es de:
                                            <?= $numeroMaquinasActivas ?>
                                            <br>
                                            Fecha Seleccionada: <?= $fecha ?>
                                        </h3>
                                    </div>
                                    <?php
                                                                        
                                    // Iterar sobre cada máquina
                                    for ($i = 1; $i <= $numeroMaquinasActivas; $i++) {
                                        try {
                                            // Consulta SQL para obtener las horas de inicio y las máquinas disponibles para un día específico
                                            $queryDispo = "SELECT hora_inicio FROM cita WHERE id_dia = :idDia and id_maquina = $i";
                                            // Preparar la consulta
                                            $statement = $pdo->prepare($queryDispo);
                                            // Asignar el valor del parámetro idDia
                                            $statement->bindParam(':idDia', $idDia, PDO::PARAM_INT);
                                            // Ejecutar la consulta
                                            $statement->execute();
                                        
                                            // Obtener los resultados
                                            $resultados = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            // Iterar sobre los resultados
                                            foreach ($resultados as $resultado) {
                                                $horaInicio = $resultado['hora_inicio'];
                                        
                                                // Haz algo con los datos, como imprimirlos o almacenarlos en una estructura de datos
                                                echo "citas anteriosres $horaInicio, en la Máquina: $i <br>";
                                            }
                                        } catch (PDOException $e) {
                                            // Manejar errores
                                            echo "Error: " . $e->getMessage();
                                        }
                                        ?>
                                        <h4 class="text-center mt-4">Máquina Nº
                                            <?= $i ?>
                                        </h4>
                                        <form autocomplete="off" method="GET" action="confirmarCita.php">
                                            <div class="card-body p-3 p-sm-5">
                                                <div class="row text-center mx-0">
                                                    <input type="hidden" name="maquina" value="<?php echo $i ?>">
                                                    <input type="hidden" name="idDia" value="<?php echo $idDia ?>">
                                                    <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                                                    <?php
                                                    // Definir la hora de inicio y la hora de fin como objetos DateTime
                                                    $inicio = new DateTime($horaInicio);
                                                    $fin = new DateTime($horaFin);

                                                    // Definir el intervalo entre las horas
                                                    $intervalo = new DateInterval('PT15M'); // Intervalo de 15 minutos
                                
                                                    // Generar las horas en un bucle
                                                    $horaActual = clone $inicio; // Clonar la hora de inicio para mantenerla inmutable
                                                    while ($horaActual <= $fin) {
                                                        // Imprimir la hora actual en formato de hora militar (24 horas)
                                                        echo '<div class="col-md-2 col-4 my-1 px-2">';
                                                        echo '<div class="cell py-1">' . $horaActual->format('H:i') . '</div>';
                                                        echo '</div>';

                                                        // Agregar el intervalo a la hora actual
                                                        $horaActual->add($intervalo);
                                                    }
                                                    ?>
                                                    <input type="hidden" id="horaSeleccionada" name="horaSeleccionada">
                                                </div>
                                                <input type="submit" name="send" value="Seleccionar Pac." class="btn btn-primary mt-4">
                                            </div>
                                        </form>
                                        <?php
                                    }
                                } else {
                                    // Si no hay máquinas activas, mostrar un mensaje indicando que no hay máquinas disponibles
                                    echo "<h3 class='text-center mt-4'>No hay máquinas disponibles.</h3>";
                                }

                            } catch (PDOException $e) {
                                // Manejar errores en caso de problemas de conexión o consulta
                                echo "Error: " . $e->getMessage();
                            }

                            echo "<p class='text-center mt-4'>El horario de este día es de: $horaInicio hasta las: $horaFin</p>";
                        }
                    }
                    ?>
                </div>
            </div>
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
    <script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>$(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                startDate: '0d'
            });

            $('.cell').click(function () {
                $('.cell').removeClass('select');
                $(this).addClass('select');
            });

        });</script>
    <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function (e) {
            e.preventDefault();
        });</script>

</body>


</html>