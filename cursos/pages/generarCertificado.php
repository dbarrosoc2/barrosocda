<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = "Registro de Asistencia";
require '../common/head.php';
require '../common/headerIniciado.php';
?>

<body>
    <div class="container mt-5">
        <h2>Certificados</h2>

        <div id="listadoEmpleados" class="mb-3">
            <!-- Los empleados se cargarán aquí dinámicamente -->
        </div>

        <div class="mb-3">
            <button id="generarCertificados" class="btn btn-primary">Generar Certificados</button>
        </div>
    </div>

    <!-- Incluir JavaScript de Bootstrap y sus dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script3.js"></script>

    <?php require __DIR__ . '/../common/footer.php' ?>
</body>

</html>