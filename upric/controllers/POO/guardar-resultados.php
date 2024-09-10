<?php
session_start();
require_once "./CLASS/Prueba-Paciente.php";
require_once "./CLASS/funciones.php";

// Declarar un array para almacenar los datos actualizados
$datos_actualizados = array();

// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    if (!isset($_POST['id_prueba'], $_POST['resultado'], $_POST['nota'])) {
        // Si falta alguno de los datos, mostrar un mensaje de error
        $_SESSION['error'] = "Error: No se recibieron todos los datos necesarios.";
        header("Location: ../../admin/pruebas/reportar.php");
        exit();
    }

    // Limpiar los datos recibidos por POST
    // $id_prueba = limpiar($_POST['id_prueba']);
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = limpiarArray($_POST['resultado']);
    $notas = limpiarArray($_POST['nota']);
    $pacienteId = limpiarArray($_POST['paciente_id']);
    $pacientesNombres = limpiarArray($_POST['paciente_nombre']);
    $pacientesApellidos = limpiarArray($_POST['paciente_apellido']);

    // Verificar que los resultados no estén vacíos
    if (empty($resultados)) {
        $_SESSION['error'] = "Error: Los resultados no pueden estar vacíos.";
        header("Location: ../../admin/pruebas/reportar.php");
        exit();
    }

    // Crear una instancia de la clase Prueba_Paciente
    $Prueba_Paciente = new Prueba_Paciente();

    // Iterar sobre los resultados y las notas
    foreach ($resultados as $id_prueba_paciente => $resultado) {
        // Verificar que el resultado no esté vacío
        if (!empty($resultado)) {
            // Obtener la nota correspondiente
            $nota = isset($notas[$id_prueba_paciente]) ? $notas[$id_prueba_paciente] : '';
            $nombrePaciente = $pacientesNombres[$id_prueba_paciente]." ".$pacientesApellidos[$id_prueba_paciente];
            $pacienteId = $pacienteId[$id_prueba_paciente];
            $fecha_reporte = getdate();

            // Ejecutar la función reportarResultadoPrueba para cada paciente
            // $Prueba_Paciente->reportarResultadoPrueba($id_paciente, $id_prueba, $resultado, $nota,  $fecha_reporte, $id_usuario);
            $Prueba_Paciente->reportarResultadoPrueba($id_prueba_paciente, $resultado, $nota,  $fecha_reporte, $id_usuario);

            // Almacenar los datos actualizados en el array
            $datos_actualizados[$id_prueba_paciente] = array(
                'resultado' => $resultado,
                'nota' => $nota,
                'paciente_nombre' => $nombrePaciente,
                'paciente_id' => $pacienteId,
            );

            // Enviar los datos actualizados a la página anterior usando sesiones
            $_SESSION['datos_actualizados'] = $datos_actualizados;
        }
    }
}

// Redireccionar a la página anterior
header("Location: ../../admin/pruebas/reportar.php");
exit;
