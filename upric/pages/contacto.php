<!DOCTYPE html>
<html lang="es">
<?php
$title = 'Inicio';
?>
<?php include '../common/head.php'; ?>

<body>
    <?php include '../common/header.php' ?>
    <?php include '../common/sidebar.php' ?>


    <main class="main-home container">
        <div class="row">
            <div class="col-md-4">
                <?php include '../common/form-login.php' ?>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">¡Nuestra Ubicación!</h2>
                    </div>
                    <div class="card-body">
                        <div class="block-content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.1401379602016!2d-67.59803142615525!3d10.250279668680552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803c9f5e854cf5%3A0x2db712d2be90341!2sHospital%20Civil%20de%20Maracay!5e0!3m2!1ses!2ses!4v1701349611286!5m2!1ses!2ses" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Contacto</h2>
                    </div>
                    <div class="card-body">
                        <div class="block-title">
                            <h2></h2>
                        </div>
                        <div class="block-content">
                            <p>Telefono: +582432330941</p>
                            <p>Correo: contacto@upric.es</p>
                        </div>
                        <div class="block-footer">
                            <a href="https://www.corposaludaragua.gob.ve/index.php/login">CorpoSaludAragua</a> | <a href="http://mpps.gob.ve/">MPPPS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../common/footer.php'; ?>
</body>

</html>