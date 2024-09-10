<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "LOGIN";
require_once '../common/head.php';
require_once './Logs.php'; //clase para gestionar la trazabilidad 
$logs = new Logger();
$ocultarFormulario = "block";
?>

<body style="background-color: #f8f9fa;">
    <?php
    if (isset($_SESSION['errorDatos'])) {
        $mensaje = '<div class="alert alert-danger text-center" role="alert">';
        $mensaje .= 'Usuario y/o contraseña incorrectos';
        $mensaje .= '</div>';
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        echo $mensaje;
    }
    $errores = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        function limpiar($variable)
        {
            $variable = trim(htmlspecialchars(stripslashes($variable)));
            return $variable;
        }
        $user = isset($_POST['user']) ? limpiar($_POST['user']) : " ";
        $pass = isset($_POST['pass']) ? limpiar($_POST['pass']) : " ";
        $hora = isset($_POST['hora_login']) ? limpiar($_POST['hora_login']) : " ";

        if (empty($user)) {
            $errores['a'] = '<div class="alert alert-danger text-center" role="alert">';
            $errores['a'] .= 'Ingresa por favor un usuario';
            $errores['a'] .= '</div>';
        }
        if (empty($pass)) {
            $errores['b'] = '<div class="alert alert-danger text-center" role="alert">';
            $errores['b'] .= 'Por favor ingresa tu contraseña';
            $errores['b'] .= '</div>';

        }
        if (empty($hora)) {
            $errores['c'] = '<div class="alert alert-danger text-center" role="alert">';
            $errores['c'] .= '****Error en el envio del formulario****';
            $errores['c'] .= '</div>';

        }

        if (empty($errores)) {
            $mensaje = '';
            if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
                $site = "10.35.50.32";
                $port = 6544;
                set_time_limit(0);
                $fp = fsockopen($site, $port, $errno, $errstr, 10);
                if (!$fp) {
                    echo "$errstr ($errno)\n";
                    $logs->login($user, $pass, $_SERVER['REMOTE_ADDR'], "Error o en usuario o clave1");
                } else {
                    //log ok 
                    $myObj = new stdClass();
                    $myObj->user = $user;
                    $myObj->password = $pass;
                    $myJSON = json_encode($myObj);
                    $a = fwrite($fp, $myJSON);
                    while (!feof($fp)) {
                        //echo $a;
                        $output = fgets($fp, 2048);
                    }
                    $obj = json_decode($output);

                    $_SESSION['a'] = $obj;

                }
            }
            if ($obj->error == null && $obj->rol != 'Sin permisos') {
                $logs->login($user, $pass, $_SERVER['REMOTE_ADDR'], "Login Correcto");
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = $hora;
                $_SESSION['usuario'] = $obj->usuario;
                //$_SESSION['rol'] = $obj->rol;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['nombre'] = $obj->nombre;
                $_SESSION['apellidos'] = $obj->apellidos;
                $_SESSION['telefono'] = $obj->telefono;
                $_SESSION['email'] = $obj->email;
                $_SESSION['idempleado'] = $obj->idempleado;
                $_SESSION['pass'] = $_POST['pass'];
                // var_dump($_SESSION);
                //header('Refresh: 0; URL = login.php');
                if (isset($_SESSION['valid'])) {
                    // var_dump($output);
                    // var_dump($obj);
                    // var_dump($a);
                    header("Location: validacionBBDDinterna.php?password=" . urlencode($pass));
                    exit();
                }
            } elseif ($obj->error == null && $obj->rol == 'Sin permisos') {
                $logs->login($user, $pass, $_SERVER['REMOTE_ADDR'], "Usuario sin permisos");
                $mensaje = '<div class="alert alert-danger text-center" role="alert">';
                $mensaje .= 'Usuario sin Permisos';
                $mensaje .= '</div>';
                echo $mensaje;
            } else {
                $logs->login($user, $pass, $_SERVER['REMOTE_ADDR'], "Datos no validos");
                $mensaje = '<div class="alert alert-danger text-center" role="alert">';
                $mensaje .= 'Los datos suministrados no son correctos';
                $mensaje .= '</div>';
                echo $mensaje;
            }
        } else {
            $logs->login($user, $pass, $_SERVER['REMOTE_ADDR'], "Error o en usuario o clave");
            $mensaje = '<div class="alert alert-danger text-center" role="alert">';
            $mensaje .= 'Debes ingresar tu nombre de usuario y la contraseña';
            $mensaje .= '</div>';
            echo $mensaje;
        }
    } else {
        echo "<div class='alert alert-danger'>";
        echo implode("<br>", $errores);
        echo "</div>";
    }

    ?>
    <div class="container mt-3">
        <div class="container-fluid h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-6 text-center bg-white p-4 rounded">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="../public/logo.jpg" alt="logoHospital" class="img-fluid">
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: <?= $ocultarFormulario; ?>">
                            <h1 class="text-center mb-4">
                                <span class="d-block"
                                    style="font-size: 1.5rem; font-family: 'YourFont', sans-serif;">Gestión de Cursos y
                                    Certificados</span>
                                <span class="d-block"
                                    style="font-size: 1rem; font-family: 'YourFont', sans-serif;">Inicio de
                                    sesión</span>
                            </h1>

                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="mb-3">
                                    <label for="user" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="user" id="user">
                                </div>
                                <div class="mb-3">
                                    <label for="pass" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" name="pass" id="pass">
                                </div>
                                <input type="hidden" name="hora_login" id="hora_login"
                                    value="<?php echo date('d-m-Y H:i:s'); ?>">
                                <button type="submit" class="btn btn-primary" name="submit">Acceder</button>
                            </form>
                        </div>
                        <div class="mt-1">
                            <a href="#" class="text-decoration-none">
                                <br><br><br><br>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <br><br><br>
    <?php
    require __DIR__ . '/../common/footer.php';
    ?>
</body>

</html>