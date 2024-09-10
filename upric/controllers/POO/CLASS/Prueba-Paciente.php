<?php
require_once 'funciones.php';
class Prueba_Paciente
{
    private $conn;
    private $table_name = "prueba_paciente";

    public function __construct()
    {
        $this->conn = require "../../controllers/database-connection.php";
    }

    public function imprimirPruebaPorId($idPrueba)
    {
        try {
            $query = "SELECT nombre_prueba, valor_ref_min, valor_ref_max, unidades FROM prueba WHERE id_prueba = :idPrueba";
            $stmt = $this->conn->prepare($query);

            // Vinculación del parámetro
            $stmt->bindParam(":idPrueba", $idPrueba);
            $stmt->execute();

            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($resultado)) {
                echo "<div class='alert alert-danger'>No se encontró ninguna prueba con el ID especificado.</div>";
                exit();
            }

            // Imprimir los datos si se encontró una prueba con el ID dado
            echo
            "<div class='alert alert-info'>
                <i class='bi bi-info-circle'></i>
                <span class='fw-bold me-2'>{$resultado['nombre_prueba']}</span> 
                <small>(Min: {$resultado['valor_ref_min']} {$resultado['unidades']} - Max: {$resultado['valor_ref_max']} {$resultado['unidades']})</small>
            </div>";
        } catch (PDOException $e) {
            die("<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>");
        }
    }

    public function ingresarDatosPacientePrueba($id_paciente, $pruebas_array_id, $comentarios, $fecha_toma_muestra)
    {
        try {
            // Iniciar transacción para asegurarnos de que todas las inserciones se hagan correctamente
            $this->conn->beginTransaction();

            // Preparar la consulta SQL para insertar los datos
            $query = "INSERT INTO {$this->table_name} (id_paciente, id_prueba, notas, fecha_toma_muestra, fecha_registro) VALUES (:id_paciente, :id_prueba, :notas, :fecha_toma_muestra, NOW())";
            $stmt = $this->conn->prepare($query);

            // Vincular los parámetros que son comunes para todas las inserciones
            $stmt->bindParam(':id_paciente', $id_paciente);
            $stmt->bindParam(':notas', $comentarios);
            $stmt->bindParam(':fecha_toma_muestra', $fecha_toma_muestra);

            // Iterar sobre las pruebas ingresadas y agregar la información al mensaje
            $query = "SELECT nombre, apellido FROM paciente WHERE id_paciente = :id_paciente";
            $stmt_nombre_paciente = $this->conn->prepare($query);
            $stmt_nombre_paciente->bindParam(':id_paciente', $id_paciente);
            $stmt_nombre_paciente->execute();
            $nombrePaciente = $stmt_nombre_paciente->fetch();
            $pruebasData = array("fecha" => $fecha_toma_muestra, "paciente" => "{$nombrePaciente["nombre"]} {$nombrePaciente["apellido"]}", "pruebas" => []);


            foreach ($pruebas_array_id as $id_prueba) {
                // Vincular el ID de la prueba específica para esta iteración
                $stmt->bindParam(':id_prueba', $id_prueba);
                $stmt->execute();

                // Obtener el nombre de la prueba
                $query = "SELECT nombre_prueba FROM prueba WHERE id_prueba = :id_prueba";
                $stmt_nombre_prueba = $this->conn->prepare($query);
                $stmt_nombre_prueba->bindParam(':id_prueba', $id_prueba);
                $stmt_nombre_prueba->execute();
                $nombre_prueba = $stmt_nombre_prueba->fetchColumn();

                array_push($pruebasData["pruebas"],  $nombre_prueba);
            }

            // Comprometer la transacción
            $this->conn->commit();

            return $pruebasData;
        } catch (PDOException $e) {
            // En caso de error, revertir la transacción
            $this->conn->rollBack();
            die("Error: " . $e->getMessage() . "<br>");
        }
    }


    ////COMO BASE, PERO NO ES LA FUNCION DEFINITIVA SE QUIERE REPORTAR POR NUM PACIENTE Y POR PRUEBA
    // public function reportarResultadoPrueba($id_paciente, $id_prueba, $resultado, $nota, $fecha_reporte, $id_usuario)
    public function reportarResultadoPrueba($id_prueba_paciente, $resultado, $nota,  $fecha_reporte, $id_usuario)
    {
        try {
            // Iniciar transacción
            $this->conn->beginTransaction();

            // Preparar la consulta SQL para actualizar los datos del resultado de la prueba
            // $query = "UPDATE " . $this->table_name . " SET resultado = :resultado, id_usuario = :id_usuario, notas = :nota, fecha_diagnostico = :fecha_reporte WHERE id_paciente = :id_paciente AND id_prueba = :id_prueba";

            $query = "UPDATE " . $this->table_name . " SET resultado = :resultado, notas = :nota, id_usuario = :id_usuario WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(':id', $id_prueba_paciente);
            $stmt->bindParam(':resultado', $resultado);
            $stmt->bindParam(':nota', $nota);
            $stmt->bindParam(':id_usuario', $id_usuario);
            // $stmt->bindParam(':fecha_reporte', $fecha_reporte);
            // $stmt->bindParam(':id_paciente', $id_paciente);
            // $stmt->bindParam(':id_prueba', $id_prueba);

            // Ejecutar la consulta
            $stmt->execute();

            // Comprometer la transacción
            $this->conn->commit();
        } catch (PDOException $e) {
            // En caso de error, revertir la transacción
            $this->conn->rollBack();
            die("Error: " . $e->getMessage() . "<br>");
        }
    }



    public function listarPacientesParaResultados($id_prueba)
    {
        try {
            // Preparar la consulta SQL para seleccionar los id_pacientes basados en id_prueba
            // Nota: La cláusula ORDER BY va después de la cláusula WHERE
            $query = "SELECT pp.id, pa.nombre, pa.apellido, pa.id_paciente 
            FROM prueba_paciente as pp
            JOIN paciente AS pa ON pp.id_paciente = pa.id_paciente
            WHERE id_prueba = :id_prueba 
            AND resultado IS NULL  -- Filtrar filas donde el campo 'resultado' está vacío
            ORDER BY id_paciente ASC";
            $stmt = $this->conn->prepare($query);

            // Vincular el parámetro id_prueba a la consulta
            $stmt->bindParam(':id_prueba', $id_prueba);

            // Ejecutar la consulta
            $stmt->execute();

            // Recuperar los resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            // Manejar el error
            die("Error: " . $e->getMessage() . "<br>");
        }
    }


    public function listarPacientesPendientes($id_prueba)
    {
        try {
            // Preparar la consulta SQL para seleccionar los id_pacientes pendientes para una prueba específica
            $query = "SELECT pp.id_paciente 
                      FROM prueba_paciente pp 
                      WHERE pp.id_prueba = :id_prueba 
                      AND NOT EXISTS (SELECT 1 FROM resultados r 
                                      WHERE r.id_paciente = pp.id_paciente 
                                      AND r.id_prueba = pp.id_prueba)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_prueba', $id_prueba);

            // Ejecutar la consulta
            $stmt->execute();

            // Recuperar los resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage() . "<br>");
        }
    }

    // esta es la funcion para buscar los resultados de ese paciente 
    public function consultarPruebasPorPaciente($idPaciente)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT 
                    p.nombre_prueba, 
                    p.valor_ref_min, 
                    p.valor_ref_max, 
                    p.unidades, 
                    pp.resultado, 
                    pp.fecha_toma_muestra, 
                    pa.nombre, 
                    pa.apellido, 
                    pa.fecha_nac
                FROM 
                    prueba AS p
                JOIN 
                    prueba_paciente AS pp ON p.id_prueba = pp.id_prueba
                JOIN 
                    paciente AS pa ON pp.id_paciente = pa.id_paciente
                WHERE
                    pa.id_paciente = :idPaciente
            ");

            $stmt->bindParam(':idPaciente', $idPaciente);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Imprimir encabezado con información del paciente
            if (!empty($result)) {
                echo "Nombre: " . $result[0]['nombre'] . " " . $result[0]['apellido'] . "\n";
                echo "Fecha de nacimiento: " . $result[0]['fecha_nac'] . "\n";
                echo "Fecha de toma de muestra: " . $result[0]['fecha_toma_muestra'] . "\n\n";

                // Imprimir resultados de las pruebas
                foreach ($result as $row) {
                    echo "Prueba: " . $row['nombre_prueba'] . "\n";
                    echo "Resultado: " . $row['resultado'] . " " . $row['unidades'] . "\n";
                    echo "Valores de referencia: " . $row['valor_ref_min'] . " - " . $row['valor_ref_max'] . " " . $row['unidades'] . "\n\n";
                }
            } else {
                echo "No se encontraron resultados para el paciente con ID " . $idPaciente . "\n";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function generarPDFPruebasPorPaciente($idPaciente, $fecha)
    {
        try {
            // Obtener información del paciente y los resultados de las pruebas
            require_once('TCPDF-main/tcpdf.php');
            $stmt = $this->conn->prepare("
        SELECT 
            p.nombre_prueba, 
            p.valor_ref_min, 
            p.valor_ref_max, 
            p.unidades, 
            pp.resultado, 
            pp.fecha_toma_muestra, 
            pa.nombre, 
            pa.apellido, 
            pa.fecha_nac
        FROM 
            prueba AS p
        JOIN 
            prueba_paciente AS pp ON p.id_prueba = pp.id_prueba
        JOIN 
            paciente AS pa ON pp.id_paciente = pa.id_paciente
        WHERE
            pa.id_paciente = :idPaciente 
            AND pp.fecha_toma_muestra = :fecha 
            AND pp.resultado IS NOT NULL
    ");
            $stmt->bindParam(':idPaciente', $idPaciente);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Crear instancia de TCPDF
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            // Agregar una página
            $pdf->AddPage();
            // Establecer el estilo de fuente
            $pdf->SetFont('helvetica', '', 10);

            // Definir el logo como marca de agua
            $pdf->SetAlpha(0.1);
            $pdf->Image('./CLASS/1.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->SetAlpha(1);

            // Agregar imagen de logo genérico con tamaño reducido
            $logo = './CLASS/1.jpg'; // Nombre del archivo del logo
            if (file_exists($logo)) {
                $pdf->Image($logo, 10, 10, 18, 18, '', '', '', false, 300, '', false, false, 0);
            }

            // Agregar título con interlineado ajustado
            $pdf->Cell(0, 5, 'CORPORACION DE SALUD DEL ESTADO ARAGUA (CORPOSALUD)', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Ambulatorio Urbano Dr. Efraín Abad Armas', 0, 1, 'C');
            $pdf->Cell(0, 5, 'UNIDAD PROGRAMÁTICA REGIONAL DE INMUNOLOGÍA CLÍNICA (UPRIC)', 0, 1, 'C');
            $pdf->Ln(5); // Espacio pequeño antes de la línea

            // Imprimir una línea
            $pdf->Cell(0, 0, '', 'T'); // Línea horizontal

            // Imprimir encabezado con información del paciente
            if (!empty($result)) {
                $nombreCompleto = $result[0]['nombre'] . ' ' . $result[0]['apellido'];
                $fechaNacimiento = new DateTime($result[0]['fecha_nac']);
                $edad = $fechaNacimiento->diff(new DateTime('now'))->y;

                // Imprimir nombre, edad y fecha de toma de muestra
                $pdf->Ln(5); // Espacio pequeño antes de la información del paciente
                $pdf->MultiCell(0, 10, 'Nombre: ' . $nombreCompleto . ' - Edad: ' . $edad . ' años');
                $pdf->Cell(0, 10, 'Fecha de toma de muestra: ' . $result[0]['fecha_toma_muestra'], 0, 1);

                // Crear tabla para los resultados de las pruebas
                $pdf->Ln(); // Agregar espacio antes de la tabla
                $pdf->SetFont('helvetica', 'B', 12); // Establecer fuente en negrita para encabezados de tabla
                $pdf->Cell(45, 10, 'Prueba', 0, 0, 'C');
                $pdf->Cell(30, 10, 'Resultado', 0, 0, 'C');
                $pdf->Cell(30, 10, 'Valor Min', 0, 0, 'C');
                $pdf->Cell(30, 10, 'Valor Max', 0, 0, 'C');
                $pdf->Cell(35, 10, 'Unidades', 0, 1, 'C');
                $pdf->SetFont('helvetica', '', 12); // Restaurar fuente normal

                // Imprimir resultados de las pruebas en la tabla
                foreach ($result as $row) {
                    $pdf->Cell(45, 10, $row['nombre_prueba'], 0, 0, 'C');
                    $pdf->Cell(30, 10, $row['resultado'], 0, 0, 'C');
                    $pdf->Cell(30, 10, $row['valor_ref_min'], 0, 0, 'C');
                    $pdf->Cell(30, 10, $row['valor_ref_max'], 0, 0, 'C');
                    $pdf->Cell(35, 10, $row['unidades'], 0, 1, 'C');
                }

                // Agregar información del bioanalista para la firma
                $pdf->Ln(10); // Espacio antes de la información del bioanalista
                $pdf->Cell(0, 10, 'Bioanalista:', 0, 1, 'L');
                $pdf->Cell(0, 10, $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' - Colegiado: ' . $_SESSION['num_colegiado'], 0, 1, 'L');
            } else {
                // Imprimir mensaje de no se encontraron resultados válidos
                $pdf->Ln(10); // Espacio antes del mensaje
                $pdf->SetFont('helvetica', 'B', 12); // Establecer fuente en negrita
                $pdf->MultiCell(0, 10, 'No se encontraron resultados válidos para el paciente con ID ' . $idPaciente, 0, 'C');
            }

            // Salida del PDF
            $pdf->Output('resultado_pruebas.pdf', 'I', '_blank');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }







    public function __destruct()
    {
        $this->conn = null;
    }
}
