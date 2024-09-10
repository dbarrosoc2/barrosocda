<?php
$destinatario = '6';
$mensaje = 'Este es un mensaje de prueba desde PHP';

// Detalles de la pasarela de mensajes
$api_url = 'https://ejemplo.com/api/send_sms';
$api_key = 'tu_clave_de_api';

// Datos a enviar a la pasarela de mensajes
$data = array(
    'api_key' => $api_key,
    'to' => $destinatario,
    'message' => $mensaje
);

// Inicializar la solicitud CURL
$ch = curl_init($api_url);

// Configurar opciones de solicitud CURL
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud CURL
$response = curl_exec($ch);

// Verificar si hay errores
if (curl_errno($ch)) {
    echo 'Error al enviar el SMS: ' . curl_error($ch);
} else {
    echo 'SMS enviado correctamente.';
}

// Cerrar la solicitud CURL
curl_close($ch);
?>