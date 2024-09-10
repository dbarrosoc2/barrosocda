<?php
class Logger
{
    private $pdo;

    public function __construct()
    {
        $host = 'db5015927825.hosting-data.io';
        $dbname = 'dbs12981728';
        $username = 'dbu1023870';
        $password = 'umYNiq_3h8bi:VN';

        try {
            // Conexión a la base de datos utilizando PDO
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la conexión o consulta
            echo "Error: en la conexion a la base de datos " . $e->getMessage();
        }
    }

    public function login($user, $pass, $ip, $comentario)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, pass, ip, operacion, observacion) VALUES (?, ?, ?, 'login', ?)");
            $stmt->execute([$user, $pass, $ip, $comentario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserciÃ³n
            echo "Error al registrar el inicio de sesion: " . $e->getMessage();
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
            // Manejo de errores en caso de fallo en la inserciÃ³n
            echo "Error al registrar la navegacion : " . $e->getMessage();
        }
    }

    public function logaut($id_usuario, $ip, $comentario)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO logs (id_usuario, ip, operacion, observacion) VALUES (?, ?, 'Cierre sesion', ?)");
            $stmt->execute([$id_usuario, $ip, $comentario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inserciÃ³n
            echo "Error al registrar el inicio de sesiÃ³n: " . $e->getMessage();
        }
    }
}
?>