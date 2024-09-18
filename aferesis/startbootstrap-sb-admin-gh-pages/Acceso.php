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

    public function login($user, $pass) {
        // Usar una consulta preparada para evitar inyecciones SQL
        $sql = "SELECT * FROM personal WHERE din = :user";
        $stmt = $this->pdo->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute(['user' => $user]);

        // Obtener el resultado
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            // Verificar la contraseña
            if (password_verify($pass, $userData['password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return "Usuario no encontrado.";
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

    public function obtenerCantidadDonantes()
    {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) AS cantidad_donantes FROM donante");
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                return $resultado['cantidad_donantes'];
            } else {
                return 0; // No hay donantes registrados
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error al consultar la cantidad de donantes: " . $e->getMessage();
            return 0;
        }
    }

    public function obtenerCantidadCitasFuturas()
    {
        try {
            // Obtener la fecha actual
            $fechaActual = date('Y-m-d');

            // Consultar el id_dia correspondiente a la fecha actual en la tabla calendario
            $stmt = $this->pdo->prepare("SELECT id_dia FROM calendario WHERE fecha = ?");
            $stmt->execute([$fechaActual]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $idDiaActual = $resultado['id_dia'];

                // Contar las citas cuyo id_dia sea mayor o igual al id_dia actual
                $stmtCitas = $this->pdo->prepare("SELECT COUNT(*) AS cantidad_citas FROM cita WHERE id_dia >= ?");
                $stmtCitas->execute([$idDiaActual]);
                $resultadoCitas = $stmtCitas->fetch(PDO::FETCH_ASSOC);

                if ($resultadoCitas) {
                    return $resultadoCitas['cantidad_citas'];
                } else {
                    return 0; // No hay citas futuras
                }
            } else {
                return 0; // No se encontró el id_dia para la fecha actual
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error al consultar la cantidad de citas futuras: " . $e->getMessage();
            return 0;
        }
    }

    public function obtenerCantidadMaquinasActivas()
    {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) AS cantidad_maquinas_activas FROM maquina WHERE activa = 'SI'");
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                return $resultado['cantidad_maquinas_activas'];
            } else {
                return 0; // No hay máquinas activas
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error al consultar la cantidad de máquinas activas: " . $e->getMessage();
            return 0;
        }
    }

    public function obtenerCantidadUsuariosRegistrados()
    {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) AS cantidad_usuarios FROM usuario");
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                return $resultado['cantidad_usuarios'];
            } else {
                return 0; // No hay usuarios registrados
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error al consultar la cantidad de usuarios registrados: " . $e->getMessage();
            return 0;
        }
    }
}
?>