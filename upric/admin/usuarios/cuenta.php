<?php
include '../../common/session-checker.php';
$title = "Mi cuenta";
$description = "Modificar datos personales registrados.";
$panelAdmin = true;
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php'; ?>
    <?php include '../../common/sidebar.php';
    include_once '../../controllers/POO/CLASS/Usuarios.php';
    $user = new Usuario(); ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>

        <div class="card">
            <div class="card-body">
                <form class="row g-4 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" value="<?= $_SESSION['dni']  ?>" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="50" required>
                            <label for="dni">DNI</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= $_SESSION['nombre'] ?>" id="nombre" placeholder="Nombre" name="nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= $_SESSION['apellido'] ?>" id="apellido" placeholder="Apellido" name="apellido" required>
                            <label for="apellido">Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= $_SESSION['usuario'] ?>" id="username" placeholder="Nombre de usuario" name="username" required>
                            <label for="username">Nombre de usuario</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="num_colegiado" value="<?= $_SESSION['num_colegiado'] ?>" name="num_colegiado" placeholder="Número de Colegiado" required>
                            <label for="num_colegiado">Número de Colegiado</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= $_SESSION['permiso'] ?>" id="permiso" name="permiso" placeholder="Tipo de permiso" required disabled>
                            <label for="permiso">Permiso</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="id_usuario" value="<?= $_SESSION['id_usuario'] ?>" name="id_usuario" placeholder="Id de usuario" required disabled>
                            <label for="id_usuario">Id de usuario</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="submit">Actualizar datos</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $user->editarUsuario($_SESSION['id_usuario'], $_POST['dni'],  $_POST['nombre'],  $_POST['apellido'],  $_POST['username'],  $_POST['num_colegiado'], $_SESSION['permiso']);

            $modalTitle = "¡Usuario actualizado!";
            $modalDescription = "Tus datos de usuario fueron  <strong>actualizados correctamente</strong>.";
            include '../../common/modal-success.php';
        }
        ?>
    </main>
    <?php require_once __DIR__ . '/../../common/footer.php'; ?>
</body>

</html>