<?php
function limpiar($variable)
{
    $variable = htmlspecialchars(stripslashes(trim($variable)));
    return $variable;
}

function limpiarArray($array)
{
    // Inicializar un nuevo array para almacenar los valores limpios
    $array_limpio = array();

    // Iterar sobre cada elemento del array
    foreach ($array as $clave => $valor) {
        // Llamar a la función limpiar para limpiar el valor
        $valor_limpio = limpiar($valor);

        // Almacenar el valor limpio en el nuevo array
        $array_limpio[$clave] = $valor_limpio;
    }

    // Devolver el array limpio
    return $array_limpio;
}
