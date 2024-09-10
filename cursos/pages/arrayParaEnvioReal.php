<?php

//Datos recibidos por POST
$idSolicitud = $_POST['id_solicitud'];
$nombreCurso = $_GET['nombreCurso'];


$telefono = [];
foreach ($_POST['telefono'] as $clave => $valor) {
    $telefono[] = trim($valor);
}

// Datos recibidos por GET
$nombre = [];
foreach ($_POST['nombre_solicitante'] as $clave => $valor) {
    $nombre[] = trim($valor);
}

$fecha = date("YmdHis");

$data = array(
    'accion' => "enviar",
    'curso' => $nombreCurso,
    'idSolicitud' => $idSolicitud,
    'nombres' => $nombre,
    'telefono' => $telefono,
    'fecha' => $fecha
);

echo "<pre>";
var_dump($data);
echo "</pre>";
$json_data = json_encode($data);


// // // Mensaje base
// $message = "Hola %s,\n\n";
// $message .= "Te informamos que has sido aprobada tu admision con respecto a la solicitud bajo el ID: %s.\n";
// $message .= "Para el curso curso '%s' se llevará a cabo de la siguiente forma %s.\n";
// $message .= "¡Esperamos contar contigo debes confirmar tu asistencia en el siguiente enlace!\n";
// $message .= "www.confirmarasistencia.com <br>Saludos,";



// // // Iterar sobre los datos y enviar mensajes
// try {
//     foreach ($idSolicitud as $index => $id_solicitud) {
//         $nombre_solicitante = trim($nombres[$index]);
//         $telefono = trim($telefono[$index]);

//         // Personalizar el mensaje con los datos actuales
//         $custom_message = sprintf($message, $nombre_solicitante, $id_solicitud, $nombreCurso, $fecha);

//         echo $custom_message . "<br>";

//         echo "Mensaje enviado exitosamente a " . $nombre_solicitante . " Telefono: " . $telefono . "<br><br>";
//     }
// } catch (Exception $e) {
//     echo "Error al enviar el mensaje: " . $e->getMessage();
// }
// ?>



<!-- 
//Datos recibidos por POST
$idSolicitud = $_POST['id_solicitud'];
$nombres = $_POST['nombre_solicitante'];
$telefono = $_POST['telefono'];

// Datos recibidos por GET
$nombreCurso = $_GET['nombreCurso'];
$fecha = $_GET['fecha'];

$from = 'Elnumeroqueseenviara';

// // Mensaje base
$message = "Hola %s,\n\n";
$message .= "Te informamos que has sido admitido con respecto a la solicitud bajo el ID: %s.\n";
$message .= "Para el curso curso '%s' se llevará a cabo de la siguiente forma %s.\n";
$message .= "¡Esperamos contar contigo!\n";
$message .= "Saludos,";



// // Iterar sobre los datos y enviar mensajes
try {
    foreach ($idSolicitud as $index => $id_solicitud) {
        $nombre_solicitante = trim($nombres[$index]);
        $telefono = trim($telefono[$index]);

        // Número de teléfono del destinatario
        $to = $telefono;

        // Personalizar el mensaje con los datos actuales
        $custom_message = sprintf($message, $nombre_solicitante, $id_solicitud, $nombreCurso, $fecha);

        // Envía el mensaje de texto
        $client->messages->create(
            $to,
            [
                'from' => $from,
                'body' => $custom_message
            ]
        );

        echo "Mensaje enviado exitosamente a $nombre_solicitante.<br>";
    }
} catch (Exception $e) {
    echo "Error al enviar el mensaje: " . $e->getMessage();
}
?> -->