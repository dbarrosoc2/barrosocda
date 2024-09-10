<?php
session_start();
require("../common/url-base.php");
if (isset($_SESSION['valid'])) {
  header("Location: $url_base_http/admin/panel.php");

  echo "<script>window.location.replace('$url_base_http/admin/panel.php')</script>";
}

$title = "Login";
?>

<!DOCTYPE html>
<html lang="es">

<?php include "../common/head.php";?>

<body>
    <?php include "../common/header.php"; ?>
    <?php include '../common/sidebar.php'; ?>
    <main>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                  <div class="card mb-3">
                    <div class="card-body">
                        <?php if (isset($_SESSION['errores'])) { ?>
                            <div class='alert alert-danger'><?= $_SESSION['errores'] ?></div>
                            <?php 
                            unset($_SESSION['errores']); 
                            }
                        ?>
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Inicia sesión en tu cuenta</h5>
                        <p class="text-center small text-body-tertiary">Ingresa tu correo y contraseña para iniciar sesión.</p>
                      </div>
                      <?php include '../common/form-login.php' ?>
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