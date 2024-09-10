<?php
session_start();
$title = "Inicio";
require_once "./head.php";
require "./conexion.php";

// Definir variables para el mensaje
$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Preparar la consulta SQL para insertar la fecha en la tabla diasespeciales
        $consulta = $pdo->prepare("INSERT INTO diasespeciales (id_dia_calendario, fecha) VALUES (:id, :fecha)");

        // Vincular los parámetros
        $consulta->bindParam(":fecha", $_POST["fecha"]);
        $consulta->bindParam(":id", $_POST["id_dia_calendario"]);

        // Ejecutar la consulta
        $consulta->execute();

        // Establecer el mensaje de éxito
        $mensaje = "Se añadió el día correctamente.";
        $tipo_mensaje = "success";
    } catch (PDOException $e) {
        // Capturar y manejar errores de la base de datos
        $mensaje = "Error al añadir el día: " . $e->getMessage();
        $tipo_mensaje = "danger";
    }
}
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Alta Festivos</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Panel de opciones</li>
                </ol>

                <!-- Mensaje de éxito o error -->
                <?php if (!empty($mensaje)) { ?>
                    <div class="alert alert-<?php echo $tipo_mensaje; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>

                <!-- Formulario para agregar fechas -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="id_dia_calendario" class="form-control" required>
                            <option value="4">Festivo</option>
                            <option value="5">Otro</option>
                            <option value="6">Sin servicio</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Fecha</button>
                </form>
            </div>
        </main>
        <?php require_once "./footer.php"; ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>