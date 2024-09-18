<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?><!DOCTYPE html>
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
        body {
            background-image: url('./assets/img/prueba.jpg');
            /* Reemplaza 'ruta/a/imagen.jpg' con la ruta de tu imagen */
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
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php">Aféresis</a>
</nav>
<?php
$mensaje = '';
require "./startbootstrap-sb-admin-gh-pages/funciones.php";
require "./startbootstrap-sb-admin-gh-pages/Acceso.php";
$acc = new Acceso();




// Comprueba si el usuario ha iniciado sesión
if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
    $site = "10.35.49.125";
    $port = 6774;
    set_time_limit(0);
    $fp = fsockopen($site, $port, $errno, $errstr, 10);

    if (!$fp) {
        $mensaje = "Falla en la Conexion";
    } else {
        $myObj = new stdClass();
        $myObj->user = $_POST['user'];
        $myObj->password = $_POST['pass'];
        $myJSON = json_encode($myObj);
        $a = fwrite($fp, $myJSON);
        while (!feof($fp)) {
            $output = fgets($fp, 2048);
        }

        $json = $output;
        $obj = json_decode($json);
        if ($obj->error == null && $obj->rol != 'Sin permisos') {
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['usuario'] = $obj->usuario;
            $_SESSION['rol'] = $obj->rol;
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['nombre'] = $obj->nombre;
            $_SESSION['apellidos'] = $obj->apellidos;
            $mensaje = 'Bienvenido ' . $obj->nombre . ' ' . $obj->apellidos . '<br>Tu rol es: ' . $obj->rol . '<br>Estás conectado desde la IP: ' . $_SERVER['REMOTE_ADDR'];
            $_SESSION['mensaje'] = $mensaje;
            $ultimaConex = $acc->consultarFechaUltimoAcceso($_SESSION['usuario']);
            $_SESSION['ultimaCon'] = $ultimaConex;
            $acc->acceso($_SESSION['usuario']);
            header("Location: ./validacionInterna.php");
            exit();
        } else {
            if ($obj->error == null && $obj->rol == 'Sin permisos') {
                $mensaje = 'Usuario sin permisos';
            } else {
                $mensaje = 'Usuario o contraseña incorrecto';
            }
        }
    }
}
?>

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
</body>

</html>