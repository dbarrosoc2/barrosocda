<?php
require_once "./CLASS/Prueba.php"; 
require_once "./CLASS/funciones.php"; 

if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['id_prueba']){
    $id=limpiar($_POST['id_prueba']);
    $database= new Prueba();
    $response = $database->borrarPrueba($id);     

    return $response;
}