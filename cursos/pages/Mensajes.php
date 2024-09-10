<?php

include_once '../pages/conexion.php';

class Mensajes
{
    private $pdo;

    public function __construct()
    {
        global $host, $dbname, $username, $password; // Debes tener estas variables definidas en tu archivo de conexión
        try {
            // Conexión a la base de datos utilizando PDO
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la conexión o consulta
            echo "Error: en la conexión a la base de datos " . $e->getMessage();
        }
    }

    public function insertarMensaje($fechaEnvio, $telefonoReceptorSMS, $id_solicitud, $id_admin, $idLog)
    {
        try {
            // Preparar la consulta SQL
            $stmt = $this->pdo->prepare("INSERT INTO mensajes (fechaEnvio, telefonoReceptorSMS, id_solicitud, id_admin, idLog) VALUES (?, ?, ?, ?, ?)");

            // Ejecutar la consulta para cada teléfono y solicitud
            foreach ($telefonoReceptorSMS as $index => $telefono) {
                $stmt->execute([$fechaEnvio, $telefono, $id_solicitud[$index], $id_admin, $idLog]);
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al insertar mensaje: " . $e->getMessage();
        }
    }
}

?>