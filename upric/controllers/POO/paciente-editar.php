<?php
require_once "../../controllers/POO/CLASS/Paciente.php";
require_once '../../controllers/POO/CLASS/funciones.php';

if (isset($_POST['modificar_submit'])) {
        $database = new Paciente();

        $id_paciente = limpiar($_POST['id_paciente']);
        $dni = limpiar($_POST['dni']);
        $nombre = limpiar($_POST['nombre']);
        $nombre2 = limpiar($_POST['nombre2']);
        $apellido = limpiar($_POST['apellido']);
        $apellido2 = limpiar($_POST['apellido2']);
        $confirmatorio = limpiar($_POST['confirmatorio']);
        $fecha_confirmatorio = limpiar($_POST['fecha_confirmatorio']);
        $telefono = limpiar($_POST['telefono']);
        $fecha_nacimiento = limpiar($_POST['fecha_nac']);
        $estado = limpiar($_POST['estado']);
        $municipio = limpiar($_POST['municipio']);
        $parroquia = limpiar($_POST['parroquia']);
        $calle = limpiar($_POST['calle']);
        $resto = limpiar($_POST['resto']);
        $hospital_referencia = limpiar($_POST['hosp_ref']);
        $comentario = limpiar($_POST['comentario']);

        $database->editarPaciente($id_paciente, $dni, $nombre, $nombre2, $apellido, $apellido2, $confirmatorio, $fecha_confirmatorio, $telefono, $fecha_nacimiento, $estado, $municipio, $parroquia, $calle, $resto, $hospital_referencia, $comentario);

        header("Location: ../../admin/pacientes/consultar.php");
}
