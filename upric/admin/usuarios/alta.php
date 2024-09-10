<?php
include '../../common/session-checker.php';
require_once "../../controllers/POO/CLASS/Usuarios.php";
require_once "../../controllers/POO/CLASS/funciones.php";
require_once "../../controllers/POO/CLASS/Permisos.php";
$permisos = new Permisos();
$numPermiso = $_SESSION['permiso'];
$title = "Alta Usuarios";
$description = "Registrar usuarios en UPRIC";
$panelAdmin = true;
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';    ?>
    <?php include '../../common/sidebar.php'; ?>

    <main id="main">
        <?php include '../../common/page-title.php';
        if ($permisos->verificarPermisosSuper($numPermiso)) {
            echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
        }
        ?>
        <div class="card">
            <div class="card-body">
                <form class="row g-4 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" value="<?= isset($dni) ? $dni : ""  ?>" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="50" required>
                            <label for="dni">DNI</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($nombre) ? $nombre :  '' ?>" id="nombre" placeholder="Nombre" name="nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($apellidos) ? $apellidos :  '' ?>" id="apellidos" placeholder="Apellidos" name="apellidos" required>
                            <label for="Apellidos">Apellidos</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="usuario" value="<?= isset($usuario) ? $usuario : '' ?>" name="usuario" placeholder="usuario" required>
                            <label for="usuario">Usuario</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="permiso" name="permiso" aria-label="permiso" required>
                                <option value="1">Recepcionista</option>
                                <option value="2">Asistente</option>
                                <option value="3">Bioquimico</option>
                                <option value="4">Administrador</option>
                            </select>
                            <label for="permiso">Selecciona un tipo de permiso</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($numeroColegiado) ? $numeroColegiado : '' ?>" id="numeroColegiado" name="numeroColegiado" placeholder="numeroColegiado" required>
                            <label for="numeroColegiado">Numero Colegiado</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class='alert alert-warning' role='alert'>
                            <i class='bi bi-exclamation-triangle'></i> Para el primer inicio de sesión la contraseña sera el mismo USUARIO de acceso
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="submit">Dar de alta a usuario</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

            $dni = isset($_POST['dni']) ? limpiar($_POST['dni']) : '';
            $nombre = isset($_POST['nombre']) ? limpiar($_POST['nombre']) : '';
            $apellidos = isset($_POST['apellidos']) ? limpiar($_POST['apellidos']) : '';
            $usuario = isset($_POST['usuario']) ? limpiar($_POST['usuario']) : '';
            $permiso = isset($_POST['permiso']) ? limpiar($_POST['permiso']) : '';
            $numeroColegiado = isset($_POST['numeroColegiado']) ? limpiar($_POST['numeroColegiado']) : '';

            // Crear una instancia de la clase Paciente
            $database = new Usuario();
            $usuarioCreadoData = $database->crearUsuario($nombre, $apellidos, $dni, $usuario, md5($usuario), $numeroColegiado, $permiso);

            $modalTitle = "¡Nuevo usuario creado!";
            $modalDescription = "El usuario <strong>{$usuario}</strong> (ID {$usuarioCreadoData}), fue registrado correctamente.";
            include '../../common/modal-success.php';
        }
        ?>
    </main>
    <?php
    require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>

</html>