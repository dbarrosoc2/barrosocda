<?php
require_once 'funciones.php';
class Prueba
{
    private $conn;
    private $table_name = "prueba";

    public function __construct()
    {
        $this->conn = require "../../controllers/database-connection.php";
    }

    // Método para crear una nueva prueba
    public function crearPrueba($nombre_prueba, $valor_ref_min, $valor_ref_max, $unidades)
    {
        $nombre_prueba = limpiar($nombre_prueba);
        $valor_ref_min = limpiar($valor_ref_min);
        $valor_ref_max = limpiar($valor_ref_max);
        $unidades = limpiar($unidades);
        try {
            $query = "INSERT INTO {$this->table_name} (nombre_prueba, valor_ref_min, valor_ref_max, unidades) 
            VALUES (:nombre_prueba, :valor_ref_min, :valor_ref_max, :unidades)";

            // Vinculación de valores
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre_prueba", $nombre_prueba);
            $stmt->bindParam(":valor_ref_min", $valor_ref_min);
            $stmt->bindParam(":valor_ref_max", $valor_ref_max);
            $stmt->bindParam(":unidades", $unidades);

            if ($stmt->execute()) {
                $ultimoIdInsertado = $this->conn->lastInsertId();
                $datosPrueba = [
                    "nombre_prueba" => $nombre_prueba, 
                    "valor_ref_min" => $valor_ref_min, 
                    "valor_ref_max" => $valor_ref_max, 
                    "unidades" => $unidades, 
                ];

                return $datosPrueba;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage() . "<br>");
        }
    }
    public function mostrarPruebas()
    {
        // Usar el método leerPruebas para obtener todas las pruebas
        $stmt = $this->leerPruebas();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Método para leer las pruebas
    public function leerPruebas()
    {
        $query = "SELECT id_prueba, nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function leerPruebasParaSelect()
    {
        $query = "SELECT id_prueba, nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $opcionesHTML = "";
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Crear la opción para el select con los datos de cada prueba
            $opcionesHTML .= "<option value='" . $fila['id_prueba'] . "'>" . $fila['nombre_prueba'] . " - " . $fila['valor_ref_min'] . " a " . $fila['valor_ref_max'] . " " . $fila['unidades'] . "</option>";
        }

        return $opcionesHTML;
    }

    public function obtenerOpcionesPruebasSelect()
    {
        try {
            // Preparar la consulta SQL
            $querySelect = "SELECT id_prueba, nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM " . $this->table_name;

            // Preparar la declaración
            $stmt = $this->conn->prepare($querySelect);

            // Ejecutar la consulta
            $stmt->execute();

            // Inicializar una variable para almacenar las opciones HTML
            $opcionesHTML = "";


            // Recorrer los resultados y construir las opciones HTML
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $opcionesHTML .= "<option value='" . $fila['id_prueba'] . "'>" . $fila['nombre_prueba'] . " - " . $fila['valor_ref_min'] . " a " . $fila['valor_ref_max'] . " " . $fila['unidades'] . "</option>";
            }

            // Devolver las opciones HTML
            return $opcionesHTML;
        } catch (PDOException $e) {
            // Manejar cualquier excepción
            die("Error al obtener las opciones de prueba: " . $e->getMessage());
        }
    }


    // Método para actualizar una prueba
    public function actualizarPrueba($id_prueba, $nombre_prueba, $valor_ref_min, $valor_ref_max, $unidades)
    {
        $query = "UPDATE " . $this->table_name . " 
        SET nombre_prueba = :nombre_prueba, valor_ref_min = :valor_ref_min, valor_ref_max = :valor_ref_max, unidades = :unidades
        WHERE id_prueba = :id_prueba";

        $stmt = $this->conn->prepare($query);

        // Vinculación de valores
        $stmt->bindParam(":id_prueba", $id_prueba);
        $stmt->bindParam(":nombre_prueba", $nombre_prueba);
        $stmt->bindParam(":valor_ref_min", $valor_ref_min);
        $stmt->bindParam(":valor_ref_max", $valor_ref_max);
        $stmt->bindParam(":unidades", $unidades);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para borrar una prueba
    public function borrarPrueba($id_prueba)
    {
        if (!empty($id_prueba)) {
            $id_prueba = limpiar($id_prueba);
            try {
                session_start();
                $queryInfo = "SELECT id_prueba, nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM " . $this->table_name . " WHERE id_prueba = :id";
                $stmtInfo = $this->conn->prepare($queryInfo);
                $stmtInfo->bindParam(':id', $id_prueba);
                $stmtInfo->execute();
                $prueba = $stmtInfo->fetch(PDO::FETCH_ASSOC);

                if (!$prueba) {
                    $_SESSION['error1'] = "No se encontró la prueba con el ID especificado.";
                } else {
                    $query = "DELETE FROM {$this->table_name} WHERE id_prueba = :id_prueba";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":id_prueba", $id_prueba);
                    $resultado = $stmt->execute();
                    if ($resultado) {

                        echo "deleted";
                        exit();
                    } else {
                        // Mensaje de error
                        $_SESSION['error'] = "<div class='alert alert-danger' role='alert'>Error al eliminar el registro.</div>";
                        header("Location: ../../admin/pruebas/consultar.php");
                    }
                }
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage() . "<br>");
            }
        }
    }

    public function obtenerPruebaPorId($idPrueba)
    {
        try {
            $query = "SELECT id_prueba, nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM " . $this->table_name . " WHERE id_prueba = :idPrueba";
            $stmt = $this->conn->prepare($query);

            // Vinculación del parámetro
            $stmt->bindParam(":idPrueba", $idPrueba);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage() . "<br>");
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
