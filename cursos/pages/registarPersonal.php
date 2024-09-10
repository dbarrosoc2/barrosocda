<?php
session_start();
require 'conexion.php';
try {
    // Datos de conexión a la base de datos (reemplaza con tus propios valores)
    $host = 'localhost';
    $dbname = 'nombre_basedatos';
    $usuario = 'usuario';
    $contrasena = 'contrasena';

    // Datos del formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_SESSION['pass']; // Asegúrate de que estás utilizando algún método seguro para almacenar las contraseñas, como el hash con sal.
    $codigo_empleado = $_POST['cod_empleado'];

    // Preparar la consulta SQL
    $consulta = $pdo->prepare("INSERT INTO personal (dni, nombre, apellidos, email, telefono, password, cod_empleado, ultima_conexion) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    // Ejecutar la consulta con los parámetros adecuados
    $consulta->execute([$dni, $nombre, $apellidos, $email, $telefono, $password, $codigo_empleado]);

    // Éxito: redireccionar o mostrar un mensaje de éxito
    header("Location: inicio.php");
    exit();
} catch (PDOException $e) {
    // Error: manejar la excepción de alguna manera (mostrar un mensaje de error, registrar el error, etc.)
    echo "Error al insertar datos en la base de datos: " . $e->getMessage();
}
?>