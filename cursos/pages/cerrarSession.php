<?php
ob_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Vaciar las variables guardadas */
session_start();
session_unset();
/* Cerrar sesión */
session_destroy();
header('Refresh: 3; URL = ../pages/login.php');
exit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | Gestión de Cursos y Certificados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .container-inicio {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-style-5 {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
        }

        .icono {
            font-size: 48px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container-inicio">
        <div class="form-style-5">
            <legend><span class="titulo"></span> Gestión de Cursos y Certificados</legend>
            <i class="fas fa-sign-out-alt icono"></i> <!-- Icono de cierre de sesión -->
            <h4>
                <?php echo 'Cerrando la sesión'; ?>
            </h4>
        </div>
    </div>
</body>

</html>
