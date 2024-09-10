<?php
session_start();
// Incluir el archivo de encabezado común
$title = "Detalle Envío y Confirmaciones"; // Título de la página
require '../common/head.php'; // Encabezado de la página HTML
require '../common/headerIniciado.php'; // Encabezado de la página HTML
require './conexion.php'; // Conexión a la base de datos
require './Logs.php'; // Clase de registro de registros

$id_solicitud = $_GET['id_solicitud'];

try {
    // Preparar la consulta SQL para obtener los mensajes asociados a la solicitud
    $sql_notificaciones = "SELECT *
        FROM mensajes
        WHERE id_solicitud = :id_solicitud
        ORDER BY fechaEnvio DESC";

    // Preparar la consulta SQL para obtener las confirmaciones asociadas a la solicitud
    $sql_confirmaciones = "SELECT *
        FROM confirmacion 
        WHERE id_solicitud = :id_solicitud
        ORDER BY fecha_confirmacion DESC";

    // Preparar la consulta SQL para obtener las visualizaciones asociadas a la solicitud
    $sql_visualizaciones = "SELECT *
    FROM visualizacion
    WHERE id_solicitud = :id_solicitud
    ORDER BY fecha_visualizacion ASC";

    // Preparar la consulta SQL para obtener el envío de certificados asociadas a la solicitud
    $sql_certificados = "SELECT *
     FROM certificados
     WHERE id_solicitud = :id_solicitud
     ORDER BY fechaEnvio DESC";

    // Preparar y ejecutar la consulta de notificaciones
    $stmt_notificaciones = $pdo->prepare($sql_notificaciones);
    $stmt_notificaciones->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
    $stmt_notificaciones->execute();
    $notificaciones = $stmt_notificaciones->fetchAll(PDO::FETCH_ASSOC);

    // Preparar y ejecutar la consulta de confirmaciones
    $stmt_confirmaciones = $pdo->prepare($sql_confirmaciones);
    $stmt_confirmaciones->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
    $stmt_confirmaciones->execute();
    $confirmaciones = $stmt_confirmaciones->fetchAll(PDO::FETCH_ASSOC);

    // Preparar y ejecutar la consulta de visualizaciones
    $stmt_visualizaciones = $pdo->prepare($sql_visualizaciones);
    $stmt_visualizaciones->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
    $stmt_visualizaciones->execute();
    $visualizaciones = $stmt_visualizaciones->fetchAll(PDO::FETCH_ASSOC);

    // Preparar y ejecutar la consulta de certificados
    $stmt_certificados = $pdo->prepare($sql_certificados);
    $stmt_certificados->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
    $stmt_certificados->execute();
    $certificados = $stmt_certificados->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // En caso de error, manejar la excepción
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos CSS personalizados -->
    <style>
        body {
            padding-top: 50px;
            text-align: center;
        }

        .container {
            max-width: 900px;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="my-4">Detalle de Envío de Notificaciones y Confirmaciones para la solicitud:
            <?php echo $id_solicitud; ?>
        </h2>

        <!-- Notificaciones -->
        <div class="list-group">
            <button class="list-group-item list-group-item-info" type="button" data-toggle="collapse"
                data-target="#notificacionesCollapse" aria-expanded="false"
                aria-controls="notificacionesCollapse">Notificaciones</button>
            <div class="collapse" id="notificacionesCollapse">
                <?php foreach ($notificaciones as $notificacion): ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Fecha de Envío:
                            <?php echo $notificacion['fechaEnvio']; ?>
                        </h5>
                        <p class="mb-1">Teléfono:
                            <?php echo $notificacion['TelefonoReceptorSMS']; ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Confirmaciones -->
        <div class="list-group">
            <button class="list-group-item list-group-item-info" type="button" data-toggle="collapse"
                data-target="#confirmacionesCollapse" aria-expanded="false"
                aria-controls="confirmacionesCollapse">Respuestas</button>
            <div class="collapse" id="confirmacionesCollapse">
                <?php foreach ($confirmaciones as $confirmacion): ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Respuesta:
                            <?php echo $confirmacion['confirma']; ?>
                        </h5>
                        <p class="mb-1">Fecha Confirmación:
                            <?php echo $confirmacion['fecha_confirmacion']; ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Visualizaciones -->
        <div class="list-group">
            <button class="list-group-item list-group-item-info" type="button" data-toggle="collapse"
                data-target="#visualizacionesCollapse" aria-expanded="false"
                aria-controls="visualizacionesCollapse">Visualizaciones</button>
            <div class="collapse" id="visualizacionesCollapse">
                <?php foreach ($visualizaciones as $visualizacion): ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Fecha visualización:
                            <?php echo $visualizacion['fecha_visualizacion']; ?>
                        </h5>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Envío de Certificados -->
        <div class="list-group">
            <button class="list-group-item list-group-item-info" type="button" data-toggle="collapse"
                data-target="#certificadosCollapse" aria-expanded="false" aria-controls="certificadosCollapse">Envío de
                Certificados</button>
            <div class="collapse" id="certificadosCollapse">
                <?php foreach ($certificados as $certificado): ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Fecha de Envío:
                            <?php echo $certificado['fechaEnvio']; ?>
                        </h5>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>