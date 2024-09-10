<?php

require_once "Conexion.php";

class Maquinas
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
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la conexión o consulta
            echo "Error: en la conexión a la base de datos " . $e->getMessage();
        }
    }

    public function altaMaquina($descripcion, $estado)
    {
        try {
            // Consulta SQL para insertar una nueva máquina
            $query = "INSERT INTO maquina (descripcion_maquina, activa) VALUES (:descripcion, :estado)";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estado', $estado);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolver un mensaje de éxito
            return "La máquina se agregó correctamente a la base de datos.";
        } catch (PDOException $e) {
            // Manejar errores en caso de problemas de conexión o consulta
            throw new Exception("Error: en la conexión a la base de datos " . $e->getMessage());
        }
    }

    public function listarMaquinas()
    {
        try {
            // Consulta SQL para seleccionar todas las máquinas
            $query = "SELECT * FROM maquina";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $maquinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Iniciar la tabla HTML
            $output = '<table class="table">';
            $output .= '<thead><tr><th>ID</th><th>Descripción</th><th>Activa</th><th>Estado</th></tr></thead>';
            $output .= '<tbody>';

            // Iterar sobre cada máquina y crear filas de tabla
            $alternate = true;
            foreach ($maquinas as $maquina) {
                // Alternar entre clases de colores para filas
                $row_class = $alternate ? 'table-primary' : 'table-secondary';
                $output .= '<tr class="' . $row_class . ' clickable-row" data-id="' . $maquina['id_maquina'] . '">';
                // Mostrar solo los últimos cuatro dígitos del ID
                $id_maquina = substr($maquina['id_maquina'], -5);
                $output .= '<td>' . $id_maquina . '</td>';
                $output .= '<td>' . $maquina['descripcion_maquina'] . '</td>';
                $output .= '<td>' . $maquina['activa'] . '</td>';
                // Incluir el estado actual de la máquina en el formulario
                $output .= '<td>';
                $output .= '<form method="post">';
                $output .= '<input type="hidden" name="id_maquina" value="' . $maquina['id_maquina'] . '">';
                $output .= '<input type="hidden" name="estado_actual" value="' . $maquina['activa'] . '">';
                $output .= '<button type="submit" class="btn btn-sm btn-danger" name="boton_presionado" value="true">Cambiar Estado</button>';
                $output .= '</form>';
                $output .= '</td>';
                $output .= '</tr>';
                // Alternar para la próxima fila
                $alternate = !$alternate;
            }

            // Cerrar la tabla HTML
            $output .= '</tbody></table>';

            // Devolver los resultados
            return $output;
        } catch (PDOException $e) {
            // Manejar errores en caso de problemas de conexión o consulta
            return "Error: en la conexión a la base de datos " . $e->getMessage();
        }
    }

    public function actualizarEstadoMaquina($id_maquina, $estado_maquina)
    {
        try {
            // Invertir el estado de la máquina
            $nuevo_estado = ($estado_maquina == "SI") ? "NO" : "SI";

            // Consulta SQL para actualizar el estado de la máquina
            $query = "UPDATE maquina SET activa = :nuevo_estado WHERE id_maquina = :id_maquina";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(':nuevo_estado', $nuevo_estado);
            $stmt->bindParam(':id_maquina', $id_maquina);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolver el nuevo estado de la máquina
            return $nuevo_estado;
        } catch (PDOException $e) {
            // Manejar errores en caso de problemas de conexión o consulta
            throw new Exception("Error: en la conexión a la base de datos " . $e->getMessage());
        }
    }
}
