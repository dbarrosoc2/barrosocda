<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

    if (isset($_SESSION['errorDatos'])) {
        $mensaje = '<div class="alert alert-danger text-center" role="alert">';
        $mensaje .= 'Usuario y/o contraseña incorrectos';
        $mensaje .= '</div>';
        unset($_SESSION['errorDatos']); // Only unset errorDatos, don't destroy the whole session
    }


    $errores = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        function limpiar($variable) {
            return trim(htmlspecialchars(stripslashes($variable)));
        }

        $user = isset($_POST['user']) ? limpiar($_POST['user']) : "";
        $pass = isset($_POST['pass']) ? limpiar($_POST['pass']) : "";
        $hora = isset($_POST['hora_login']) ? limpiar($_POST['hora_login']) : "";

        if (empty($user)) {
            $errores['a'] = '<div class="alert alert-danger text-center" role="alert">Ingresa por favor un usuario</div>';
        }
        if (empty($pass)) {
            $errores['b'] = '<div class="alert alert-danger text-center" role="alert">Por favor ingresa tu contraseña</div>';
        }
        if (empty($hora)) {
            $errores['c'] = '<div class="alert alert-danger text-center" role="alert">****Error en el envio del formulario****</div>';
        }
        if (empty($errores)) {
            try {
                // Requiere la conexión a la base de datos
                require 'conexion.php';

                // Consulta para verificar el usuario
                $consulta = $pdo->prepare("SELECT dni, cod_empleado, nombre, apellidos, email, telefono, password, ultima_conexion, rol 
                                           FROM personal 
                                           WHERE dni = :dni AND password = :password");
                $consulta->bindParam(':dni', $user); 
                $consulta->bindParam(':password', $pass); 
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

                if ($resultado) { // If a row is returned, the user exists and password matches
                    // Redirige a loginOk por que todo va OK...!
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = $hora;
                    $_SESSION['usuario'] = $resultado['dni'];
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['nombre'] = $resultado['nombre'];
                    $_SESSION['apellidos'] = $resultado['apellidos'];
                    $_SESSION['telefono'] = $resultado['telefono'];
                    $_SESSION['email'] = $resultado['email'];
                    $_SESSION['idempleado'] = $resultado['cod_empleado'];
                    $_SESSION['rol'] = $resultado['rol'];
                    
                    header("Location: inicio.php");
                    exit();

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
    ?>



<!DOCTYPE html>
<html lang="en">
<?php
$title = "LOGIN";
require_once '../common/head.php';
$ocultarFormulario = "block";
?>
<body style="background-color: #f8f9fa;">
    <div class="container mt-3">
        <div class="container-fluid h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-6 col-lg-4 text-center bg-white p-4 rounded shadow-sm">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="../public/logo.jpg" alt="logoHospital" class="img-fluid">
                    </div>
                    <div class="card">
                        <div class="card-body" style="display: <?= $ocultarFormulario; ?>">
                            <h1 class="text-center mb-4">
                                <span class="d-block" style="font-size: 1.5rem; font-family: 'YourFont', sans-serif;">Gestión de Cursos y Certificados</span>
                                <span class="d-block" style="font-size: 1rem; font-family: 'YourFont', sans-serif;">Inicio de sesión</span>
                            </h1>
                            <?php
                            if (isset($mensaje)) {
                                echo $mensaje;
                            }
                            ?>
                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="mb-3">
                                    <label for="user" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="user" id="user">
                                </div>
                                <div class="mb-3">
                                    <label for="pass" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" name="pass" id="pass">
                                </div>
                                <input type="hidden" name="hora_login" id="hora_login" value="<?= date('d-m-Y H:i:s'); ?>">
                                <button type="submit" class="btn btn-primary w-100" name="submit">Acceder</button>
                            </form>
                            <a href="#" class="d-block mt-3">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="mt-1">
                            <a href="#" class="d-block">Regístrate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require __DIR__ . '/../common/footer.php';
    ?>
</body>
</html>