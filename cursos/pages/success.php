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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">¡Inicio de sesión exitoso!</h4>
                <p>Has iniciado sesión correctamente. Haz clic en el botón de abajo para continuar.</p>
            </div>
            <a href="inicio.php" class="btn btn-primary btn-lg">Continuar</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
