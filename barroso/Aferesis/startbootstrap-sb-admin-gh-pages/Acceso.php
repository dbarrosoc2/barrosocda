<?php
class Acceso
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

    public function acceso($usuario)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO acceso (id_usuario) VALUES (?)");
            $stmt->execute([$usuario]);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la inser
            echo "Error al registrar la navegacion : " . $e->getMessage();
        }
    }
    public function consultarFechaUltimoAcceso($idUsuario)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT MAX(fecha) AS fecha_ultimo_acceso FROM acceso WHERE id_usuario = ?");
            $stmt->execute([$idUsuario]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                return $resultado['fecha_ultimo_acceso'];
            } else {
                return null; // El usuario no tiene registros de acceso
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error al consultar la fecha de último acceso: " . $e->getMessage();
            return null;
        }
    }

}
?>