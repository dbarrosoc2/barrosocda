<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar el almacenamiento en buffer de salida
ob_start();

$mensaje = '';
require "funciones.php";
require "Acceso.php";
$acc = new Acceso();
session_start();

// Comprueba si el usuario ha iniciado sesión
if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {

    $user = isset($_POST['user']) ? limpiar($_POST['user']) : "";
  	$_SESSION['usuario']=$user;
    $pass = isset($_POST['pass']) ? limpiar($_POST['pass']) : "";

    if (empty($user)) {
        $errores['a'] = '<div class="alert alert-danger text-center" role="alert">Ingresa por favor un usuario</div>';
    }
    if (empty($pass)) {
        $errores['b'] = '<div class="alert alert-danger text-center" role="alert">Por favor ingresa tu contraseña</div>';
    }

    if (empty($errores)) {
        try {
            // Requiere la conexión a la base de datos
            require 'conexion.php';

            // Consulta para verificar el usuario
            $consulta = $pdo->prepare("SELECT dni, cod_empleado, nombre, apellidos, email, password, id_rol 
                                           FROM personal 
                                           WHERE dni = :dni AND password = :password");
            $consulta->bindParam(':dni', $user); // Assuming $user is the DNI
            $consulta->bindParam(':password', $pass); // Assuming $pass is the plain password
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) { 
                $_SESSION['valid'] = true;
                $_SESSION['usuario'] = $resultado['dni'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['apellidos'] = $resultado['apellidos'];
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['idempleado'] = $resultado['cod_empleado'];
                $_SESSION['rol'] = $resultado['id_rol'];
              session_write_close();
					if($_SESSION['valid']){
                      header("Location: ./inicio.php");
                      exit();
                    }                   
            } else {
                $_SESSION['errorDatos'] = true;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Finaliza el almacenamiento en buffer de salida
ob_end_flush();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('./assets/img/prueba.jpg');
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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Aféresis</a>
    </nav>
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
                                            <input name="user" class="form-control <?= isset($mensaje) ? 'is-invalid' : '' ?>" type="text" placeholder="Usuario" />
                                            <?php if (isset($mensaje)) : ?>
                                                <label for="inputUsuario">Usuario</label>
                                                <div class="invalid-feedback">
                                                    <?= $mensaje ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="pass" type="password" placeholder="Contraseña" />
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
        <?php require "footer.php"; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
