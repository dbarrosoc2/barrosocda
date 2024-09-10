<?php
session_start();
require_once "./CLASS/funciones.php";

require_once './CLASS/Prueba-Paciente.php';




// Verificar si se ha enviado el ID del paciente y la fecha por GET
if (isset($_GET['idPaciente'])) {
    // Limpiar los valores del ID del paciente y la fecha
    $idPaciente = limpiar($_GET['idPaciente']);
    $partes = explode('|', $idPaciente);

    // $partes[0] contendrá "636"
    $id_paciente = $partes[0];

    // $partes[1] contendrá "2024-01-01"
    $fechaTomaMuestra = $partes[1];

    // Verificar que los valores no estén vacíos
    if (!empty($id_paciente) && !empty($fechaTomaMuestra)) {
        // Crear una instancia de la clase Prueba_Paciente
        $database = new Prueba_Paciente();

        // Llamar a la función generarPDFPruebasPorPaciente con el ID del paciente y la fecha como argumentos
        $database->generarPDFPruebasPorPaciente($id_paciente, $fechaTomaMuestra);
    } else {
        echo "Error: El ID del paciente y la fecha deben ser proporcionados.";
    }
} else {
    // Manejar el caso en que no se reciba el ID del paciente y la fecha
    echo "Error: No se ha proporcionado el ID del paciente y la fecha.";
}
