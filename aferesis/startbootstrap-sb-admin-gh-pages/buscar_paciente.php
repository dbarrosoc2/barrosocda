<?php
// buscar_paciente.php

// Incluir archivo de conexión y clase Donantes
require_once 'conexion.php';
require_once 'Donantes.php';

// Obtener el término de búsqueda del parámetro GET
$q = $_GET['q'];

// Realizar la búsqueda de pacientes utilizando la clase Donantes y la conexión $pdo
$donantes = new Donantes();
$resultados = $donantes->buscarPacienteDinamico($q);

// Mostrar los resultados
if (!empty($resultados)) {
    foreach ($resultados as $paciente) {
        echo "<p>" . $paciente['nombre'] . "</p>"; // Cambia 'nombre' por el campo que desees mostrar
    }
} else {
    echo "No se encontraron pacientes.";
}
?>