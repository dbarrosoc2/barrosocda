<?php
require_once "./CLASS/Usuarios.php";
require_once "./CLASS/funciones.php";
if (isset($_POST['accion']) && $_POST['accion'] == 'editar' && isset($_POST['id_usuario'])) {
    $id = limpiar($_POST['id_usuario']);
    $nombre = limpiar($_POST['nombre']);
    $apellido = limpiar($_POST['apellidos']);
    $dni = limpiar($_POST['dni']);
    $usuario = limpiar($_POST['usuario']);
    $permiso = limpiar($_POST['permiso']);
    $num_colegiado = limpiar($_POST['num_colegiado']);


    $database = new Usuario();
    $resultado = $database->editarUsuario($id, $dni, $nombre, $apellido, $usuario, $num_colegiado, $permiso);

    session_start();
    if ($resultado) {
        $_SESSION['mensaje'] = $nombre;
    } else {
        $_SESSION['error'] = "Error al actualizar el usuario.";
    }

    header("Location: ../../admin/usuarios/consultar.php");
}
