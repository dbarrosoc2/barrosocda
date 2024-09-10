<?php

class Paciente
{
    private $conn;
    private $table_name = "paciente";

    // Propiedades del paciente
    private $dni;
    private $nombre;
    private $nombre2;
    private $apellido;
    private $apellido2;
    private $confirmatorio;
    private $fecha_confirmatorio;
    private $telefono;
    private $fecha_nacimiento;
    private $estado;
    private $municipio;
    private $parroquia;
    private $calle;
    private $resto;
    private $hospital_referencia;
    private $comentario;

    public function __construct()
    {
        $this->conn = require "../../controllers/database-connection.php";
    }

    public function mostrarPacientes()
    {
        // Usar el método leerPruebas para obtener todas los usuarios
        $stmt = $this->leerPacientes();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Método para leer las pruebas
    public function leerPacientes()
    {
    $query = "SELECT id_paciente, dni, nombre, nombre2, apellido, apellido2, confirmatorio, fecha_confirmatorio, telefono, fecha_nac, estado, municipio, parroquia, calle, resto, hosp_ref, comentario 
              FROM " . $this->table_name . " 
              ORDER BY apellido ASC, nombre ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
    }
    public function listarPacientesParaSelect()
    {
        try {
            $queryPac = "SELECT id_paciente, dni, nombre, apellido, apellido2 FROM paciente ORDER BY apellido ASC";
            $stmtPac = $this->conn->prepare($queryPac);
            $stmtPac->execute();

            $opcionesPacHTML = "";

            while ($filaPac = $stmtPac->fetch(PDO::FETCH_ASSOC)) {
                // Crear la opción para el select con los datos de cada paciente
                $opcionesPacHTML .= "<option value='{$filaPac['id_paciente']}'> {$filaPac['nombre']} {$filaPac['apellido']} {$filaPac['apellido2']} / DNI {$filaPac['dni']}</option>";
            }

            return $opcionesPacHTML;
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            echo "Error al listar pacientes: " . $e->getMessage();
            return ""; // Devolver cadena vacía en caso de error
        }
    }

    public function listarPacientesParaSelectImpre()
    {
        try {
            $query = "SELECT p.id_paciente, p.dni, p.nombre, p.apellido, p.apellido2, pp.fecha_toma_muestra
                    FROM paciente p
                    INNER JOIN prueba_paciente pp ON p.id_paciente = pp.id_paciente
                    ORDER BY p.apellido ASC, p.nombre ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $opcionesPacHTML = "";
            $fechasTomaMuestra = array();

            while ($filaPac = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!in_array($filaPac['fecha_toma_muestra'], $fechasTomaMuestra)) {
                    $valorOpcion = "{$filaPac['id_paciente']} | {$filaPac['fecha_toma_muestra']}";
                    $opcionesPacHTML .= "<option value='$valorOpcion'>{$filaPac['nombre']} {$filaPac['apellido']} {$filaPac['apellido2']} /  DNI {$filaPac['dni']} / Fecha de toma de muestra {$filaPac['fecha_toma_muestra']} </option>";
                    $fechasTomaMuestra[] = $filaPac['fecha_toma_muestra'];
                }
            }

            return $opcionesPacHTML;
        } catch (PDOException $e) {
            echo "Error al listar pacientes: " . $e->getMessage();
            return "";
        }
    }



    // Método para borrar un paciente
    public function borrarPaciente($id)
    {
        if (!empty($id)) {
            $id = limpiar($id);
            // Primero, obtenemos los datos del paciente que se va a eliminar
            $queryInfo = "SELECT dni, nombre, apellido FROM {$this->table_name} WHERE id_paciente = :id";

            try {
                session_start();
                $stmtInfo = $this->conn->prepare($queryInfo);
                $stmtInfo->bindParam(':id', $id);
                $stmtInfo->execute();
                $paciente = $stmtInfo->fetch(PDO::FETCH_ASSOC);

                if (!$paciente) {
                    $_SESSION['error1'] = "No se encontró el paciente con el ID especificado.";
                } else {

                    // Ahora, procedemos a eliminar el paciente
                    $queryDelete = "DELETE FROM $this->table_name WHERE id_paciente = :id";
                    $stmtDelete = $this->conn->prepare($queryDelete);
                    $stmtDelete->bindParam(':id', $id);
                    $resultado = $stmtDelete->execute();
                    if ($resultado) {

                        echo "deleted";
                        exit();
                    } else {
                        // Mensaje de error
                        $_SESSION['error'] = "<div class='alert alert-danger' role='alert'>Error al eliminar el registro.</div>";
                        header("Location: ../../admin/pacientes/consultar.php");
                    }
                }
            } catch (PDOException $e) {
                die("Error al procesar la solicitud: " . $e->getMessage());
            }
        }
    }

    public function consultarPaciente($busqueda)
    {
        try {
            $query = "SELECT * FROM paciente 
                    WHERE id_paciente LIKE '$busqueda'
                    OR dni LIKE '$busqueda'
                    OR nombre LIKE '$busqueda'
                    OR nombre2 LIKE '$busqueda'
                    OR apellido LIKE '$busqueda' 
                    OR apellido2 LIKE '$busqueda'
                    OR telefono LIKE '$busqueda'
                    ORDER BY apellido ASC, nombre ASC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    }



    // Método para insertar un paciente
    public function crearPaciente($dni, $nombre, $nombre2, $apellido, $apellido2, $confirmatorio, $fecha_confirmatorio, $telefono, $fecha_nacimiento, $estado, $municipio, $parroquia, $calle, $resto, $hospital_referencia, $comentario)
    {
        $query = "INSERT INTO " . $this->table_name . " (dni, nombre, nombre2, apellido, apellido2, confirmatorio, fecha_confirmatorio,
        telefono, fecha_nac, estado, municipio, parroquia, calle, resto, hosp_ref, comentario) 
        VALUES (:dni, :nombre, :nombre2, :apellido, :apellido2, :confirmatorio, :fecha_confirmatorio, 
        :telefono, :fecha_nacimiento, :estado, :municipio, :parroquia, :calle, :resto, :hospital_referencia, :comentario)";

        $stmt = $this->conn->prepare($query);

        // Vinculación de valores usando propiedades de clase
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":nombre2", $nombre2);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":apellido2", $apellido2);
        $stmt->bindParam(":confirmatorio", $confirmatorio);
        $stmt->bindParam(":fecha_confirmatorio", $fecha_confirmatorio);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":municipio", $municipio);
        $stmt->bindParam(":parroquia", $parroquia);
        $stmt->bindParam(":calle", $calle);
        $stmt->bindParam(":resto", $resto);
        $stmt->bindParam(":hospital_referencia", $hospital_referencia);
        $stmt->bindParam(":comentario", $comentario);

        if ($stmt->execute()) {
            $ultimoIdInsertado = $this->conn->lastInsertId();

            return [
                "nombre" => $nombre . " " . $nombre2,
                "apellido" => $apellido . " " . $apellido2,
                "dni" => $dni,
                "telefono" => $telefono,
            ];
        }
    }

    // Método para editar un paciente
    public function obtenerPacientePorNumRegistro($busqueda)
    {
        $query = "SELECT id_paciente ,dni, nombre, nombre2, apellido, apellido2, confirmatorio, fecha_confirmatorio,
                    telefono, fecha_nac, estado, municipio, parroquia, calle, resto, hosp_ref, comentario
                FROM paciente 
                WHERE id_paciente = :busqueda";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':busqueda', $busqueda);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    public function editarPaciente($id_paciente, $dni, $nombre, $nombre2, $apellido, $apellido2, $confirmatorio, $fecha_confirmatorio, $telefono, $fecha_nacimiento, $estado, $municipio, $parroquia, $calle, $resto, $hospital_referencia, $comentario)
    {
        $id_paciente = limpiar($id_paciente);
        $dni = limpiar($dni);
        $nombre = limpiar($nombre);
        $nombre2 = limpiar($nombre2);
        $apellido = limpiar($apellido);
        $apellido2 = limpiar($apellido2);
        $confirmatorio = limpiar($confirmatorio);
        $fecha_confirmatorio = limpiar($fecha_confirmatorio);
        $telefono = limpiar($telefono);
        $fecha_nacimiento = limpiar($fecha_nacimiento);
        $estado = limpiar($estado);
        $municipio = limpiar($municipio);
        $parroquia = limpiar($parroquia);
        $calle = limpiar($calle);
        $resto = limpiar($resto);
        $hospital_referencia = limpiar($hospital_referencia);
        $comentario = limpiar($comentario);
        $query = "UPDATE {$this->table_name}
    SET dni=:dni, nombre=:nombre, nombre2=:nombre2, apellido=:apellido, apellido2=:apellido2, confirmatorio=:confirmatorio, fecha_confirmatorio=:fecha_confirmatorio,
    telefono=:telefono, fecha_nac=:fecha_nacimiento, estado=:estado, municipio=:municipio, parroquia=:parroquia, calle=:calle, resto=:resto, hosp_ref=:hospital_referencia, comentario=:comentario
    WHERE id_paciente = :id_paciente";

        $stmt = $this->conn->prepare($query);

        // Vinculación de valores
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":nombre2", $nombre2);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":apellido2", $apellido2);
        $stmt->bindParam(":confirmatorio", $confirmatorio);
        $stmt->bindParam(":fecha_confirmatorio", $fecha_confirmatorio);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":municipio", $municipio);
        $stmt->bindParam(":parroquia", $parroquia);
        $stmt->bindParam(":calle", $calle);
        $stmt->bindParam(":resto", $resto);
        $stmt->bindParam(":hospital_referencia", $hospital_referencia);
        $stmt->bindParam(":comentario", $comentario);
        $stmt->bindParam(":id_paciente", $id_paciente);

        if ($stmt->execute()) {
            session_start();

            // Guardar el mensaje en $_SESSION
            $_SESSION['mensaje'] = "$nombre $apellido";
        }
    }
}
