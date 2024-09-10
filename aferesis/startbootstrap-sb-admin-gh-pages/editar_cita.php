<?php

require_once "./Citas.php";
$cita = new Citas();
$cita->editarCita($_GET['id']);