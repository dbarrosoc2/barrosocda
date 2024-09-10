<?php
session_start();
require("../../common/url-base.php");
require("../../controllers/funciones.php");
$title = "Cambio Contraseña";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = isset($_POST['password']) ? $_POST['password'] : "";
    $confirmacion = isset($_POST['confirmacion']) ? $_POST['confirmacion'] : "";

    if (empty($pass) || empty($confirmacion)) {
        $error = "Alguno de los campos esta vacio.";
    } elseif ($pass != $confirmacion) {
        $error = "Ambos campos deben ser iguales.";
    } else {
        require_once "../../controllers/POO/CLASS/Usuarios.php";
        $user = new Usuario();
        $user->cambiarClavePrimera($_SESSION['id_usuario'], $pass, $confirmacion);
        header("Location: ../panel.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include "../../common/head.php"; ?>

<body>
    <?php include "../../common/header.php"; ?>
    <main>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                <?php if (!empty($error)) { ?>
                                    <div class='alert alert-danger'><?= $error ?></div>
                                <?php } ?>
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Debes Actualizar tu contraseña</h5>
                                    <p class="text-center small text-body-tertiary">Ingresa tu contraseña y confirma esa contraseña.</p>
                                </div>
                                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" id="password" name="password" class="form-control" required placeholder="Contraseña">
                                            <label for="password">Ingresa tu nueva Contraseña</label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" id="password2" name="confirmacion" class="form-control" required placeholder="Contraseña">
                                            <label for="confirmacion">Ingresa de nuevo tu contraseña</label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Cambiar Contraseña</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../common/footer.php'; ?>
</body>

</html>