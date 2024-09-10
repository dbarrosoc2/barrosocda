<?php
require_once "./CLASS/Usuarios.php";
require_once "./CLASS/funciones.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['id_usuario']) {
    $id = limpiar($_POST['id_usuario']);
    $database = new Usuario();
    $response = $database->borrarUsuario($id);

    return $response;
}