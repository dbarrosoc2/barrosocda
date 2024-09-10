<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>horarios_disponibles</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
        /* Estilos del scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Otros estilos */
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #C5CAE9 !important;
            background-repeat: no-repeat;
            padding: 0px !important;
        }

        .container-fluid {
            padding-top: 20px !important;
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
            color: #fff !important;
            background-color: #f00 !important;
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
</head>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

<body className='snippet-body'>
   
    <div class="container-fluid px-0 px-sm-4 mx-auto">
        <div class="row justify-content-center mx-0">
            <div class="col-lg-10">
                <div class="card border-0">
                    <form autocomplete="off" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="card-header bg-dark">
                            <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
                                <input type="text" id="dp1" class="datepicker" placeholder="Escoge una fecha"
                                    name="date" readonly><span class="fa fa-calendar"></span>
                                <input type="submit" value="Enviar" name="diaSeleccionado">
                                <hr>
                                <div class="text-center mt-4">
                                        <a href="inicio.php" class="btn btn-secondary">Volver a Inicio</a>
                                    </div>
                            </div>
                        </div>
                    </form>
                    

                    <?php
                    if (isset($_POST['diaSeleccionado'])) {
                        $fechaOldForm = $_POST['date'];
                        $fecha = DateTime::createFromFormat('d-m-Y', $fechaOldForm)->format('Y-m-d');
                        require 'conexion.php';
                        try {
                            $query = "SELECT descripcion_dia, hora_inicio, hora_fin, id_dia
                                      FROM calendario                
                                      WHERE fecha = :fecha";
                            $statement = $pdo->prepare($query);
                            $statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                            $statement->execute();
                            $fila = $statement->fetch(PDO::FETCH_ASSOC);

                            if ($fila) {
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

                        if (isset($horaInicio) && isset($horaFin)) {
                            try {
                                require './conexion.php';
                                $queryMaquina = "SELECT COUNT(activa) FROM maquina WHERE activa = 'SI'";
                                $stmt = $pdo->prepare($queryMaquina);
                                $stmt->execute();
                                $numeroMaquinasActivas = $stmt->fetchColumn();

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
                                    for ($i = 1; $i <= $numeroMaquinasActivas; $i++) {
                                        try {
                                            $queryDispo = "SELECT hora_inicio FROM cita WHERE id_dia = :idDia and id_maquina = $i";
                                            $statement = $pdo->prepare($queryDispo);
                                            $statement->bindParam(':idDia', $idDia, PDO::PARAM_INT);
                                            $statement->execute();
                                            $resultados = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            $horaCitas = [];
                                            if (!empty($resultados)) {
                                                foreach ($resultados as $resultado) {
                                                    $horaCitas[] = $resultado['hora_inicio'];
                                                }
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                        ?>
                                        <h4 class="text-center mt-4">Máquina Nº
                                            <?= $i ?>
                                        </h4>
                                        <form autocomplete="off" method="POST" action="confirmarCita.php">
                                            <div class="card-body p-3 p-sm-5">
                                                <div class="row text-center mx-0">
                                                    <input type="hidden" name="maquina" value="<?php echo $i ?>">
                                                    <input type="hidden" name="idDia" value="<?php echo $idDia ?>">
                                                    <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                                                    <?php
                                                    $inicio = new DateTime($horaInicio);
                                                    $fin = new DateTime($horaFin);
                                                    $intervalo = new DateInterval('PT15M');
                                                    $bloqueoDuracion = new DateInterval('PT2H30M');
                                                    $horaActual = clone $inicio;

                                                    $horasDisponibles = [];

                                                    while ($horaActual <= $fin) {
                                                        $horaSiguiente = clone $horaActual;
                                                        $horaSiguiente->add($bloqueoDuracion);

                                                        $disponible = true;

                                                        foreach ($horaCitas as $horaCita) {
                                                            $cita = new DateTime($horaCita);
                                                            if (
                                                                ($horaActual <= $cita && $cita < $horaSiguiente) || 
                                                                ($cita <= $horaActual && $horaActual < $cita->add($bloqueoDuracion))
                                                            ) {
                                                                $disponible = false;
                                                                break;
                                                            }
                                                        }

                                                        if ($disponible) {
                                                            $horasDisponibles[] = clone $horaActual;
                                                        }

                                                        $horaActual->add($intervalo);
                                                    }

                                                    if (count($horasDisponibles) > 0) {
                                                        foreach ($horasDisponibles as $horaDisponible) {
                                                            echo '<div class="col-md-2 col-4 my-1 px-2">';
                                                            echo '<div class="cell py-1">' . $horaDisponible->format('H:i') . '</div>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-12 my-1 px-2">';
                                                        echo '<div class="alert alert-warning" role="alert">Para este dia y en esta máquina no existen horas disponibles.</div>';
                                                        echo '</div>'; 
                                                    }
                                                    ?>
                                                    <input type="hidden" id="horaSeleccionada<?php echo $i; ?>" name="horaSeleccionada">
                                                </div>
                                                <input type="submit" name="sends" value="Seleccionar Pac." class="btn btn-primary mt-4">
                                            </div>
                                        </form>
                                        <?php
                                    }
                                } else {
                                    echo "<h3 class='text-center mt-4'>No hay máquinas disponibles.</h3>";
                                }
                            } catch (PDOException $e) {
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
    <script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                startDate: '0d'
            });

            $('.cell').click(function () {
                if (!$(this).hasClass('disabled')) {
                    $('.cell').removeClass('select');
                    $(this).addClass('select');
                    var horaSeleccionada = $(this).text().trim();
                    var maquina = $(this).closest('form').find('input[name="maquina"]').val();
                    $('#horaSeleccionada' + maquina).val(horaSeleccionada);
                }
            });
        });
    </script>
</body>

</html>