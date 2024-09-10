<?php

require_once "./Citas.php";
$cita = new Citas();
$cita->borrarCita($_GET['id']);
header('Refresh: 0; URL = calendarioUser.php?variable=' . $_GET["fecha"]);
exit();