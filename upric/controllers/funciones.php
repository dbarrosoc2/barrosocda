<?php
/*function limpiar(&$variable){
        stripslashes(trim(htmlspecialchars($variable)));
        $variable=  strtolower($variable);
    }*/
function limpiar($variable)
{
    $variable = htmlspecialchars(stripslashes(trim($variable)));
    return $variable;
}
