<?php
include_once '../pages/conexion.php';

class Logger
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

    public function login($user, $pass, $ip, $comentario)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, pass, ip, operacion, observacion) VALUES (?, ?, ?, 'login', ?)");
            $stmt->execute([$user, $pass, $ip, $comentario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al registrar el inicio de sesión: " . $e->getMessage();
        }
    }

    public function navegacion($id_usuario, $url, $ip, $comentario)
    {
        $url = substr($url, 0, 200); // Limitar a 200 caracteres
        $ip = substr($ip, 0, 45); // Limitar a 45 caracteres (IPv6)
        $comentario = substr($comentario, 0, 200); // Limitar a 200 caracteres
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, url, ip, operacion, observacion) VALUES (?, ?, ?, 'navegacion', ?)");
            $stmt->execute([$id_usuario, $url, $ip, $comentario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al registrar la navegacion : " . $e->getMessage();
        }
    }

    public function logaut($id_usuario, $ip, $comentario)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, ip, operacion, observacion) VALUES (?, ?, 'Cierre sesion', ?)");
            $stmt->execute([$id_usuario, $ip, $comentario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al registrar el inicio de sesión: " . $e->getMessage();
        }
    }

    public function cambioNombreCorto($id_usuario, $ip, $nombre)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, ip, operacion, observacion) VALUES (?, ?, 'Cambio Nombre Corto', ?)");
            $stmt->execute([$id_usuario, $ip, $nombre]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al registrar el inicio de sesión: " . $e->getMessage();
        }
    }

    // public function RegistroEnvioMensaje($telefonos)
    // {
    //     try {
    //         // Obtener el IP del cliente
    //         $ip = $_SERVER['REMOTE_ADDR'];
    //         $dni = $_SESSION['usuario'];

    //         // Convertir el array de observaciones en un string plano
    //         $telefono = implode(', ', $telefonos);

    //         // Preparar la consulta SQL
    //         $stmt = $this->pdo->prepare("INSERT INTO logsAviso (fechaCreacion, ip, dni, observacion, operacion, curso) VALUES (NOW(), :ip, :dni, 'EnvioExitoso', 'Envio comunicacion admision', :observacion)");

    //         // Ejecutar la consulta para cada observación
    //         $stmt->bindParam(':ip', $ip);
    //         $stmt->bindParam(':dni', $dni);
    //         $stmt->bindParam(':observacion', $telefono);
    //         $stmt->execute();


    //         // Cerrar la conexión
    //         $this->pdo = null;
    //     } catch (PDOException $e) {
    //         // Manejo de errores en caso de fallo en la inserción
    //         echo "Error al registrar el envío de mensaje: " . $e->getMessage();
    //     }
    // }
    public function RegistroEnvioMensaje($id_curso, $id_empleado_salud)
    {
        try {
            // Obtener el IP del cliente
            $ip = $_SERVER['REMOTE_ADDR'];
            $dni = $_SESSION['usuario'];

            // Preparar la consulta SQL
            $stmt = $this->pdo->prepare("INSERT INTO logsAviso (fechaCreacion, ip, dni, observacion, operacion, curso, id_empleado_salud) VALUES (NOW(), :ip, :dni, 'EnvioExitoso', 'Envio comunicacion admision', :curso, :id_empleado_salud)");

            // Ejecutar la consulta para cada id_empleado_salud
            foreach ($id_empleado_salud as $id_salud) {
                $stmt->bindParam(':ip', $ip);
                $stmt->bindParam(':dni', $dni);
                $stmt->bindParam(':curso', $id_curso);
                $stmt->bindParam(':id_empleado_salud', $id_salud);
                $stmt->execute();
            }

            // Recuperar el último idLog insertado
            $lastId = $this->pdo->lastInsertId();

            // Cerrar la conexión
            $this->pdo = null;

            return $lastId; // Devolver el último idLog insertado
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserción
            echo "Error al registrar el envío de mensaje: " . $e->getMessage();
        }
    }





}
?>