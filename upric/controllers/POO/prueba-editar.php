<?php
require_once "./CLASS/Prueba.php";
require_once "./CLASS/funciones.php";

if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
    if (isset($_POST['id_prueba'], $_POST['nombre_prueba'], $_POST['valor_ref_min'], $_POST['valor_ref_max'], $_POST['unidades'])) {
        $id = limpiar($_POST['id_prueba']);
        $nombrePrueba = limpiar($_POST['nombre_prueba']);
        $valorRefMin = limpiar($_POST['valor_ref_min']);
        $valorRefMax = limpiar($_POST['valor_ref_max']);
        $unidades = limpiar($_POST['unidades']);

        $database = new Prueba();
        $resultado = $database->actualizarPrueba($id, $nombrePrueba, $valorRefMin, $valorRefMax, $unidades);

        session_start();
        if ($resultado) {
            $_SESSION['mensaje'] = $nombrePrueba;
        } else {
            $_SESSION['error'] = "Error al actualizar la prueba.";
        }

        header("Location: ../../admin/pruebas/consultar.php");
    }
}
