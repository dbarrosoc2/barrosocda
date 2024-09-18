<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./startbootstrap-sb-admin-gh-pages/Acceso.php";
$acc = new Acceso();

if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
    $user = stripslashes(htmlspecialchars($_POST['user']));
    $pass = stripslashes(htmlspecialchars($_POST['pass']));

    // Intentar el login
    $userData = $acc->login($user, $pass);

    if ($userData) {
        // Iniciar la sesión
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['usuario'] = $userData['cod_empleado'];
        $_SESSION['rol'] = $userData['id_rol'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['nombre'] = $userData['nombre'];
        $_SESSION['apellidos'] = $userData['apellidos'];
        $_SESSION['email'] = $userData['email'];
        
        $mensaje = 'Bienvenido ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'] . '<br>Tu rol es: ' . $_SESSION['rol'] . '<br>Estás conectado desde la IP: ' . $_SESSION['ip'];
        $_SESSION['mensaje'] = $mensaje;

        // Consultar y guardar la fecha del último acceso
        $ultimaConex = $acc->consultarFechaUltimoAcceso($_SESSION['usuario']);
        $_SESSION['ultimaCon'] = $ultimaConex;
        
        header("Location: ./startbootstrap-sb-admin-gh-pages/inicio.php");
        exit();
    } else {
        // Mensaje de error si el login falla
        $mensaje = "Usuario o contraseña incorrectos.";
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" class="js-site-favicon" type="image/png" href="./assets/img/favIcon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aféresis | Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .warning-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffcc00;
            color: #333;
            text-align: center;
            padding: 20px;
            font-size: 18px;
            z-index: 1000;
        }
        body {
            background-image: url('./startbootstrap-sb-admin-gh-pages/assets/img/prueba.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
        }

        #layoutAuthentication {
            display: flex;
            min-height: 100vh;
        }

        #layoutAuthentication_content {
            flex: 1;
        }

        #layoutAuthentication_footer {
            width: 100%;
        }
    </style>

</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Aféresis</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <div class="form-floating mb-3">
                                            <input name="user"
                                                class="form-control <?= isset($mensaje) ? 'is-invalid' : '' ?>"
                                                type="text" placeholder="Usuario" />
                                            <?php if (isset($mensaje)): ?>
                                                <label for="inputUsuario">Usuario</label>
                                                <div class="invalid-feedback">
                                                    <?= $mensaje ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="pass" type="password"
                                                placeholder="Contraseña" />
                                            <label for="inputContraseña">Contraseña</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">¿Olvidaste tu contraseña?</a>
                                            <input class="btn btn-primary" type="submit" value="Acceder" name="submit">
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">¿Necesitas una cuenta? ¡Regístrate!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php
        require "./startbootstrap-sb-admin-gh-pages/footer.php";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        window.onload = function() {
            var message = "ATENCIÓN: Esta página está en construcción y no están listas todas las funciones. Si quieres probar, puedes acceder con\n\nUSUARIO: 12345678A\nPassword: prueba";
            alert(message);
        };
    </script>
</body>

</html>
