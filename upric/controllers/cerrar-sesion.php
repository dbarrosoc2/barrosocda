<?php
require "./POO/CLASS/Logs.php";

session_start();
$logs = new RegistroLogger("registroCSVLogin.csv");
$logs->cierreSesion($_SESSION["usuario"], "CERRADA LA SESION" );

// vaciar las variables guardadas y cerrar sesion
session_unset();
session_destroy();

header("Location: ../pages/login.php");
