<?php
session_start();
$title = "Envio SMS";
require '../common/head.php';
require '../common/headerIniciado.php';
require 'conexion.php';
require 'Logs.php';
require 'Mensajes.php';
// echo "<pre>";
// echo "POST";
// var_dump($_POST);
// echo "GET";
// var_dump($_GET);
// echo "SESSION";
// var_dump($_SESSION);
// echo "</pre>";

function quitarEspaciosEnBlanco($array)
{
    $var = [];
    foreach ($array as $clave => $valor) {
        $var[$clave] = trim($valor);
    }
    return $var;
}

$id_solicitud = isset($_GET['numeros_solicitud']) ? $_GET['numeros_solicitud'] : '';

// Verificar si $id_solicitud no está vacío antes de realizar el explode
if (!empty($id_solicitud)) {
    $id_solicitud_array = explode(',', $id_solicitud);
    $id_solicitud_array = array_map('trim', $id_solicitud_array); // Eliminar espacios en blanco
    $id_solicitud = $id_solicitud_array; // Convertir el resultado en un array

    // Resto del código...
} else {
    echo "No se proporcionaron números de solicitud.";
}

// Verificar si $id_solicitud está vacío
if (!empty($id_solicitud)) {
    $sql = "SELECT nombre, telefono, id_empleado_salud 
            FROM solicitud_curso 
            WHERE id_solicitud 
            IN (" . implode(",", $id_solicitud) . ")";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Iterar sobre los resultados para obtener los nombres completos de los solicitantes
    $nombre_solicitante = [];
    $telefono = [];
    $id_empleado_salud = [];
    foreach ($resultados as $resultado) {
        $nombre_solicitante[] = $resultado['nombre'];
        $telefono[] = $resultado['telefono'];
        $id_empleado_salud[] = $resultado['id_empleado_salud'];
    }
    // echo "<pre>";
    // var_dump($id_solicitud);
    // var_dump($telefono);
    // var_dump($id_empleado_salud);
    // var_dump($nombre_solicitante);
    // echo "</pre>";

    $accion = "enviar";
    $curso = $_GET['nombre_corto_curso'];
    // $nombre_solicitante = quitarEspaciosEnBlanco($_POST['nombre_solicitante']);
    // $telefono = quitarEspaciosEnBlanco($_POST['telefono']);
    // $id_empleado_salud = quitarEspaciosEnBlanco($_POST['id_empleado_salud']);
    $fecha = date("YmdHis");
    $id_curso = $_GET['id_curso'];


    // Resto del código...
} else {
    echo "No se proporcionaron números de solicitud.";
}

function crearArray($accion, $curso, $id_solicitud, $nombre_solicitante, $telefono, $fecha)
{
    $data = [
        'accion' => $accion,
        'curso' => $curso,
        'idSolicitud' => $id_solicitud,
        'nombre' => $nombre_solicitante,
        'telefono' => $telefono,
        'fecha' => $fecha
    ];
    return $data;
}

$data = crearArray($accion, $curso, $id_solicitud, $nombre_solicitante, $telefono, $fecha);

$site = "10.35.50.32";
$port = 6545;
set_time_limit(0);
$fp = fsockopen($site, $port, $errno, $errstr, 10);
if (!$fp) {
    echo "$errstr ($errno)\n";
} else {
    $myObj = new stdClass();
    $myObj->data = $data;
    $myJSON = json_encode($myObj);
    $a = fwrite($fp, $myJSON);
    while (!feof($fp)) {
        $output = fgets($fp, 2048);
    }
    $json = $output;
    $obj = json_decode($json);
}

if ($output) {
    // echo "<div class='alert alert-success' role='alert'>Respuesta del servidor: $output</div>";
    // Analizar la respuesta del servidor
    $respuesta = json_decode($output, true);

    // Verificar si la respuesta es "OK"
    if ($respuesta && isset($respuesta['resultado']) && $respuesta['resultado'] == "OK") {
        // Imprimir los números de teléfono y los nombres de los solicitantes
        $log = new Logger;
        $lastId = $log->RegistroEnvioMensaje($id_curso, $id_empleado_salud);
        $mensaje = new Mensajes();
        $fechaEnvio = date("Y-m-d H:i:s");
        $dniAdmin = $_SESSION['usuario'];
        $mensaje->insertarMensaje($fechaEnvio, $telefono, $id_solicitud, $dniAdmin, $lastId);

        echo "<br>";
        foreach ($telefono as $key => $value) {
            echo "<div class='alert alert-info' role='alert'>Mensaje enviado a: " . $telefono[$key] . " - " . $nombre_solicitante[$key] . "</div>";
        }

        ?>
        <a class="btn btn-primary" href="javascript:history.go(-1)">Listado de inscritos</a>
        <a class="btn btn-secondary" href="./cursos.php">Volver a Cursos</a>

        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Hubo un problema al enviar el mensaje.</div>";
    }
} else {
    echo "<div class='alert alert-warning' role='alert'>No se recibió respuesta del servidor.</div>";
}