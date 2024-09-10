<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Calendario";

require_once "./head.php";
require "./Donantes.php";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
<!-- Bootstrap JS (required for Bootstrap functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<style>
    .mes {
        margin-bottom: 2rem;
        /* Espacio entre los meses */
    }

    .rojo-claro {
        background-color: #ffcccc;
        /* Color de fondo rojo claro */
        cursor: not-allowed;
        /* Cambia el cursor a 'no permitido' */
    }
</style>

<body>


    <main>


        <?php
        require_once "./nav.php";
        require_once "./aside.php"; ?>

        <?php
        // Definir los nombres de los meses en inglés
        $meses_ingles = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        );

        // Definir los nombres de los meses en español
        $meses_espanol = array(
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        );

        // Crear un array asociativo con las traducciones
        $traducciones_meses = array_combine($meses_ingles, $meses_espanol);

        function generarCalendario($mes, $anio, $citas)
        {
            global $traducciones_meses; // Acceder a la variable global $traducciones_meses
        
            // Crear un objeto DateTime para el primer día del mes
            $fecha = new DateTime("$anio-$mes-01");

            // Obtener el nombre del mes en inglés
            $nombreMesIngles = $fecha->format('F');

            // Obtener el nombre del mes en español
            $nombreMesEspanol = isset($traducciones_meses[$nombreMesIngles]) ? $traducciones_meses[$nombreMesIngles] : $nombreMesIngles;

            // Obtener el número de días en el mes
            $numDias = $fecha->format('t');

            // Obtener el día de la semana del primer día del mes
            $primerDiaSemana = $fecha->format('N');

            // Crear un array de los nombres abreviados de los días de la semana
            $diasSemana = array('L', 'M', 'X', 'J', 'V', 'S', 'D');

            // Crear un array para almacenar las citas programadas
            $citasProgramadas = array();
            foreach ($citas as $cita) {
                $fechaCita = new DateTime($cita['fecha']);
                $citasProgramadas[$fechaCita->format('j')] = true;
            }

            // Imprimir el encabezado del calendario
            echo "<div class='mes'>";
            echo "<h2 class='text-center'>$nombreMesEspanol $anio</h2>";
            echo '<table class="table table-bordered">';
            echo '<thead><tr>';
            foreach ($diasSemana as $dia) {
                echo "<th>$dia</th>";
            }
            echo '</tr></thead>';
            echo '<tbody><tr>';
            for ($i = 1; $i < $primerDiaSemana; $i++) {
                echo '<td></td>'; // Celdas vacías antes del primer día del mes
            }
            for ($dia = 1; $dia <= $numDias; $dia++) {
                $fechaActual = $fecha->format('Y-m-d');
                $idDia = 'dia-' . $fecha->format('j');
                if ($fecha < new DateTime('today')) {
                    echo "<td class='rojo-claro' id='$idDia'>$dia</td>"; // Fecha anterior a hoy
                } elseif (isset($citasProgramadas[$dia])) {
                    echo "<td class='no-disponible' id='$idDia'>$dia</td>"; // Marcar como no disponible si hay cita programada
                } else {
                    echo "<td class='disponible abrir-ventana' id='$idDia' data-dia='$dia' data-mes='$mes' data-anio='$anio'>$dia</td>"; // Agregar la clase "abrir-ventana"
                }
                if (($dia + $primerDiaSemana - 1) % 7 == 0) {
                    echo '</tr><tr>'; // Nueva fila cada 7 días
                }
                $fecha->modify('+1 day'); // Avanzar al siguiente día
            }
            echo '</tr></tbody>';
            echo '</table>';
            echo "</div>";
        }

        // Ejemplo de uso
        $citas = array(
            array('fecha' => '2024-05-15'),
            array('fecha' => '2024-05-20'),
            array('fecha' => '2024-05-25')
        );
        ?>
        <div class="container">
            <h1 class="mt-4">
                <?= $title ?>
            </h1>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            for ($mes = 1; $mes <= 12; $mes++) {
                                if ($mes % 3 == 1) {
                                    echo '<tr>';
                                }
                                echo '<td>';
                                generarCalendario($mes, 2024, $citas);
                                echo '</td>';
                                if ($mes % 3 == 0) {
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>
<script>
    // Obtener todas las celdas de día
    var celdasDia = document.querySelectorAll('.abrir-ventana');

    // Agregar un controlador de eventos de clic a cada celda de día
    celdasDia.forEach(function (celda) {
        celda.addEventListener('click', function () {
            // Obtener el día, mes y año seleccionados
            var diaSeleccionado = this.getAttribute('data-dia');
            var mesSeleccionado = this.getAttribute('data-mes');
            var anioSeleccionado = this.getAttribute('data-anio');
            // Abrir una nueva ventana con los horarios disponibles para el día seleccionado
            var nuevaVentana = window.open('horarios_disponibles.php?dia=' + diaSeleccionado + '&mes=' + mesSeleccionado + '&anio=' + anioSeleccionado + '&submit=' + true, '_blank', 'width=800,height=500');
        });
    });
</script>

</html>