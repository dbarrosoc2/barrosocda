<?php

// Función para obtener el día de la semana en español
function obtenerDiaSemana($fecha)
{
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
    $numeroDia = date('w', strtotime($fecha));
    return $dias[$numeroDia];
}

// Abrir el archivo CSV para escritura
$archivo = fopen('calendario.csv', 'w');

// Escribir la cabecera del archivo CSV
fputcsv($archivo, array('id_dia', 'DescripcionDia', 'id_horario', 'fecha', 'hora_inicio', 'hora_fin'));

// Fecha inicial: hoy
$fechaInicio = date('Y-m-d');
// Fecha final: 14/05/2054
$fechaFin = '2054-05-14';

// Iterar desde la fecha inicial hasta la fecha final
$fechaActual = $fechaInicio;
$contadorDia = 1;
$idHorario = 1; // Por defecto, lunes a viernes
while ($fechaActual <= $fechaFin) {
    // Obtener el día de la semana y asignar el id_horario correspondiente
    $diaSemana = obtenerDiaSemana($fechaActual);
    if ($diaSemana == 'Sabado' || $diaSemana == 'Domingo') {
        $idHorario = 2; // Sábado o domingo
    } else {
        $idHorario = 1; // Lunes a viernes
    }

    // Escribir la fila en el archivo CSV
    fputcsv(
        $archivo,
        array(
            $contadorDia,
            $diaSemana,
            $idHorario,
            $fechaActual,
            '08:30:00',
            ($idHorario == 2) ? '13:00:00' : '18:00:00'
        )
    );

    // Incrementar la fecha actual
    $fechaActual = date('Y-m-d', strtotime($fechaActual . ' +1 day'));
    $contadorDia++;
}

// Cerrar el archivo CSV
fclose($archivo);

echo 'El archivo calendario.csv se ha generado con éxito.';
?>