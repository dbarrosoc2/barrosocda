<?php
session_start();
require_once './conexion.php';

$id_curso = $_SESSION['id_curso'];

// Verificar si se han recibido los números de solicitud por GET
if (isset($_GET['numeros_solicitud'])) {
    // Separar los números de solicitud en un array
    $numeros_solicitud = explode(',', $_GET['numeros_solicitud']);

    // Preparar la consulta SQL de actualización
    $placeholders = rtrim(str_repeat('?,', count($numeros_solicitud)), ',');
    $sql = "UPDATE solicitud_curso SET admitido = 'No' WHERE id_solicitud IN ({$placeholders})";

    // Preparar y ejecutar la consulta de actualización
    $stmt = $pdo->prepare($sql);
    $stmt->execute($numeros_solicitud);

    // Verificar si la consulta se ejecutó correctamente
    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de selección de participantes
        header("Location: selecionDeParticipantes.php?id_curso=" . urlencode($id_curso));
        exit();
    } else {
        echo "No se realizaron actualizaciones.";
    }
} else {
    echo "No se han recibido los números de solicitud por GET.";
}
?>