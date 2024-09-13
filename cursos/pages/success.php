<?php
session_start();
if (!isset($_SESSION['login_success']) || !$_SESSION['login_success']) {
    header("Location: login.php");
    exit();
}
unset($_SESSION['login_success']); // Elimina la variable después de mostrar el mensaje
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Correcto</title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-3">
        <div class="container-fluid h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-6 col-lg-4 text-center bg-white p-4 rounded shadow-sm">
                    <h1 class="mb-4">¡Has iniciado sesión correctamente!</h1>
                    <p>Haz clic en el botón de abajo para continuar.</p>
                    <a href="inicio.php" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
