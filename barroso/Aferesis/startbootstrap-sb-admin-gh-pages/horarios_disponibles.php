<?php
// Recibir datos por GET
$dia = isset($_GET['dia']) ? trim($_GET['dia']) : '';
$mes = isset($_GET['mes']) ? trim($_GET['mes']) : '';
$anio = isset($_GET['anio']) ? trim($_GET['anio']) : '';

// Limpiar los valores de cualquier código malicioso
$dia = htmlspecialchars($dia, ENT_QUOTES, 'UTF-8');
$mes = htmlspecialchars($mes, ENT_QUOTES, 'UTF-8');
$anio = htmlspecialchars($anio, ENT_QUOTES, 'UTF-8');

// Verificar que los valores sean números enteros válidos
if (!ctype_digit($dia) || !ctype_digit($mes) || !ctype_digit($anio)) {
    // Si alguno de los valores no es un número entero válido, manejar el error aquí
    echo "Error: Los valores deben ser números enteros.";
    exit;
}

// Convertir los valores a enteros
$dia = intval($dia);
$mes = intval($mes);
$anio = intval($anio);

// Formatear la cadena de fecha
$fecha = sprintf("%04d-%02d-%02d", $anio, $mes, $dia);

// Convertir la cadena de fecha en una marca de tiempo UNIX
$timestamp = strtotime($fecha);

// Verificar si la conversión fue exitosa
if ($timestamp === false) {
    echo "Error: No se pudo convertir la fecha.";
} else {
    // Imprimir la fecha en el formato deseado
    $numeroDiaSemana = date('w', strtotime($fecha));

    // Convertir el número del día de la semana a un nombre
    $nombresDias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $nombreDia = $nombresDias[$numeroDiaSemana];

    echo "El día $fecha es un $nombreDia.";

    switch ($numeroDiaSemana) {
        case 1: // Lunes
        case 2: // Martes
        case 3: // Miércoles
        case 4: // Jueves
        case 5: // Viernes
            $valorDia = 1;
            $horaInicio = '08:30:00';
            $horaFin = '18:00:00';
            break;
        case 0: // Domingo
        case 6: // Sábado
            $valorDia = 2;
            $horaInicio = '08:30:00';
            $horaFin = '13:00:00';
            break;
    }

    echo "El horario de este dia es de: " . $horaInicio . " hasta las: " . $horaFin;
}

?>