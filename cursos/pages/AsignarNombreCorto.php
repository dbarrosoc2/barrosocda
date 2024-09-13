<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Incluir el archivo de conexión a la base de datos
require './conexion.php';
//     // Incluir el archivo de registro de logs
require './Logs.php';

$id = isset($_GET['id_curso']) ? trim(htmlspecialchars($_GET['id_curso'])) : null;
$nombreCurso = isset($_GET['nombreCurso']) ? trim(htmlspecialchars($_GET['nombreCurso'])) : null;
$horarios = isset($_GET['horarioCurso']) ? trim(htmlspecialchars($_GET['horarioCurso'])) : null;
$nombreCorto = isset($_GET['nombreCorto']) ? trim(htmlspecialchars($_GET['nombreCorto'])) : null;

if (!empty($_POST['nombre_corto'])) {
    if (isset($_GET['id'])) {
        //     Obtener el nombre corto y el ID del curso desde los datos del formulario y la URL
        $nombreCorto = $_POST['nombre_corto'];
        $idCurso = $_GET['id'];
        //     // Preparar la consulta SQL para actualizar el nombre corto del curso
        $sql = "UPDATE curso SET nombre_corto = ? WHERE id_curso = ?";
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta SQL con los valores proporcionados
        $stmt->execute([$nombreCorto, $idCurso]);

        // Crear una instancia de Logger para registrar el cambio de nombre corto
        $log = new Logger();
        $log->cambioNombreCorto($_SESSION['usuario'], $_SERVER['REMOTE_ADDR'], "nombre es : $nombreCorto al curso $idCurso");

        // Redirigir al usuario de regreso a la página de cursos después de la actualización
        header("Location: ./cursos.php");
        exit();
    }

} else {
    // Si no se cumple la condición anterior, redirigir a la página de cursos
    header("Location: ./cursos.php");
    exit();
}
?>