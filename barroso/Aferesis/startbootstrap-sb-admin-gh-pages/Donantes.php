<?php
class Donantes
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

    public function AltaDonante($nombre, $apellido1, $apellido2, $nhc, $telefono, $dni, $cipa, $fechaNa, $aceptaComunicaciones)
    {
        try {
            // Preparar la consulta SQL
            $query = "INSERT INTO donante (nombre, apellido1, apellido2, nhc, telef1, dni, cipa, fecha_nacimiento, acepto_comunicacion) 
                  VALUES (:nombre, :apellido1, :apellido2, :nhc, :telefono, :dni, :cipa, :fechaNa, :aceptaComunicaciones)";
            $statement = $this->pdo->prepare($query);

            // Bind de parámetros
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellido1', $apellido1);
            $statement->bindParam(':apellido2', $apellido2);
            $statement->bindParam(':nhc', $nhc);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':dni', $dni);
            $statement->bindParam(':cipa', $cipa);
            $statement->bindParam(':fechaNa', $fechaNa);
            $statement->bindParam(':aceptaComunicaciones', $aceptaComunicaciones);

            // Ejecutar la consulta
            $statement->execute();

            // Si se inserta correctamente, retornar verdadero
            return true;
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
            // Retornar falso para indicar que la inserción falló
            return false;
        }
    }

    public function EditarDonante($id, $nombre, $apellido1, $apellido2, $nhc, $telefono, $dni, $cipa, $fechaNa, $aceptaComunicaciones)
    {
        try {
            // Preparar la consulta SQL
            $query = "UPDATE donante SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, nhc = :nhc, telef1 = :telefono, dni = :dni, cipa = :cipa, fecha_nacimiento = :fechaNa, acepto_comunicacion = :aceptaComunicaciones WHERE id_donante = :id";
            $statement = $this->pdo->prepare($query);

            // Bind de parámetros
            $statement->bindParam(':id', $id);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellido1', $apellido1);
            $statement->bindParam(':apellido2', $apellido2);
            $statement->bindParam(':nhc', $nhc);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':dni', $dni);
            $statement->bindParam(':cipa', $cipa);
            $statement->bindParam(':fechaNa', $fechaNa);
            $statement->bindParam(':aceptaComunicaciones', $aceptaComunicaciones);

            // Ejecutar la consulta
            $statement->execute();

            // Verificar si se actualizó al menos una fila
            if ($statement->rowCount() > 0) {
                // Si se actualiza correctamente, retornar verdadero
                return true;
            } else {
                // Si no se actualiza ninguna fila, retornar falso
                return false;
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
            // Retornar falso para indicar que la actualización falló
            return false;
        }
    }

    public function listarDonantesEditar()
    {
        try {
            // Configurar PDO para que lance excepciones en caso de errores
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para seleccionar todos los donantes
            $query = "SELECT id_donante, nombre, apellido1, apellido2, nhc, telef1, dni, fecha_nacimiento, acepto_comunicacion FROM donante";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $donantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Iniciar la tabla HTML
            $output = '<table class="table">';
            $output .= '<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>NHC</th><th>Teléfono</th><th>DNI</th><th>Fecha de Nacimiento</th><th>Acepta Comunicaciones</th></tr></thead>';
            $output .= '<tbody>';

            // Iterar sobre cada donante y crear filas de tabla
            $alternate = true;
            foreach ($donantes as $donante) {
                // Alternar entre clases de colores para filas
                $row_class = $alternate ? 'table-primary' : 'table-secondary';
                $output .= '<tr class="' . $row_class . ' clickable-row" data-id="' . $donante['id_donante'] . '">';
                // Mostrar solo los últimos cuatro dígitos del ID
                $id_donante = substr($donante['id_donante'], -5);
                $output .= '<td>' . $id_donante . '</td>';
                $output .= '<td>' . $donante['nombre'] . '</td>';
                // Concatenar apellidos
                $apellidos = $donante['apellido1'] . ' ' . $donante['apellido2'];
                $output .= '<td>' . $apellidos . '</td>';
                $output .= '<td>' . $donante['nhc'] . '</td>';
                $output .= '<td>' . $donante['telef1'] . '</td>';
                $output .= '<td>' . $donante['dni'] . '</td>';
                $output .= '<td>' . $donante['fecha_nacimiento'] . '</td>';
                $output .= '<td>' . $donante['acepto_comunicacion'] . '</td>';
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


    public function ObtenerDonantePorId($id)
    {
        try {
            // Consulta SQL para seleccionar un donante por su ID
            $query = "SELECT * FROM donante WHERE id_donante = :id";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Bind de parámetros
            $stmt->bindParam(':id', $id);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado de la consulta
            $donante = $stmt->fetch(PDO::FETCH_ASSOC);

            // Devolver el resultado
            return $donante;
        } catch (PDOException $e) {
            // Manejar errores en caso de problemas de conexión o consulta
            return null; // o podrías lanzar una excepción aquí si prefieres
        }
    }

    public function listarDonantes()
    {
        try {
            // Configurar PDO para que lance excepciones en caso de errores
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para seleccionar todos los donantes
            $query = "SELECT * FROM donante";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $donantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Iniciar la tabla HTML
            $output = '<table class="table">';
            $output .= '<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>NHC</th><th>Teléfono</th><th>DNI</th><th>Fecha de Nacimiento</th><th>Acepta Comunicaciones</th></tr></thead>';
            $output .= '<tbody>';

            // Iterar sobre cada donante y crear filas de tabla
            $alternate = true;
            foreach ($donantes as $donante) {
                // Alternar entre clases de colores para filas
                $row_class = $alternate ? 'table-primary' : 'table-secondary';
                $output .= '<tr class="' . $row_class . ' clickable-row" data-id="' . $donante['id_donante'] . '">';
                // Mostrar solo los últimos cuatro dígitos del ID
                $id_donante = substr($donante['id_donante'], -5);
                $output .= '<td>' . $id_donante . '</td>';
                $output .= '<td>' . $donante['nombre'] . '</td>';
                // Concatenar apellidos
                $apellidos = $donante['apellido1'] . ' ' . $donante['apellido2'];
                $output .= '<td>' . $apellidos . '</td>';
                $output .= '<td>' . $donante['nhc'] . '</td>';
                $output .= '<td>' . $donante['telef1'] . '</td>';
                $output .= '<td>' . $donante['dni'] . '</td>';
                $output .= '<td>' . $donante['fecha_nacimiento'] . '</td>';
                $output .= '<td>' . $donante['acepto_comunicacion'] . '</td>';
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

    public function buscarPaciente($filtro)
    {
        try {
            // Preparar la consulta SQL para buscar al paciente por nombre, apellidos, NHC, CIPA y DNI
            $query = "SELECT nombre, apellido1, apellido2 FROM donante WHERE nombre LIKE :filtro OR apellido1 LIKE :filtro OR apellido2 LIKE :filtro OR nhc LIKE :filtro OR cipa LIKE :filtro OR dni LIKE :filtro";

            // Preparar la consulta
            $stmt = $this->pdo->prepare($query);

            // Bind the parameter
            $filtro = '%' . $filtro . '%'; // Agregar los comodines '%' para buscar coincidencias parciales
            $stmt->bindParam(':filtro', $filtro, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Construir la tabla HTML para mostrar los resultados
            $output = '<table class="table">';
            $output .= '<thead><tr><th>Nombre</th><th>Apellidos</th></tr></thead>';
            $output .= '<tbody>';

            // Iterar sobre cada resultado y agregarlo a la tabla
            foreach ($resultados as $resultado) {
                $output .= '<tr>';
                $output .= '<td>' . $resultado['nombre'] . '</td>';
                $output .= '<td>' . $resultado['apellido1'] . ' ' . $resultado['apellido2'] . '</td>';
                $output .= '</tr>';
            }

            // Cerrar la tabla HTML
            $output .= '</tbody></table>';

            // Devolver la tabla HTML con los resultados
            return $output;
        } catch (PDOException $e) {
            // Manejar errores en caso de problemas de conexión o consulta
            return "Error: en la conexión a la base de datos " . $e->getMessage();
        }
    }
}
