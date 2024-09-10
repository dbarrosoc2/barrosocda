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
        // Combina la hora y los minutos de inicio
        $hora_inicio = sprintf("%02d:%02d:00", $_POST["hora_inicio"], $_POST["min_inicio"]);

        // Combina la hora y los minutos de fin
        $hora_fin = sprintf("%02d:%02d:00", $_POST["hora_fin"], $_POST["min_fin"]);

        // Preparar la consulta SQL para modificar la fecha en la tabla calendario
        $consulta = $pdo->prepare("UPDATE calendario SET id_horario = :id_horario, hora_inicio = :hora_inicio, hora_fin = :hora_fin WHERE fecha = :fecha");

        // Vincular los parámetros
        $consulta->bindParam(":fecha", $_POST["fecha"]);
        $consulta->bindParam(":id_horario", $_POST["id_dia_calendario"]);
        $consulta->bindParam(":hora_inicio", $hora_inicio);
        $consulta->bindParam(":hora_fin", $hora_fin);

        // Ejecutar la consulta
        $consulta->execute();

        // Establecer el mensaje de éxito
        $mensaje = "Se editó el día correctamente.";
        $tipo_mensaje = "success";
    } catch (PDOException $e) {
        // Capturar y manejar errores de la base de datos
        $mensaje = "Error al añadir el día: " . $e->getMessage();
        $tipo_mensaje = "danger";
    }
}

// Consulta para obtener los días festivos y otros días
try {
    $consulta_dias = $pdo->query("SELECT fecha, id_horario, hora_inicio, hora_fin FROM calendario WHERE id_horario IN (3, 4) ORDER BY fecha ASC");
    $dias = $consulta_dias->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensaje = "Error al recuperar los días: " . $e->getMessage();
    $tipo_mensaje = "danger";
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
                <h1 class="mt-4">Gestionar Días</h1>
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
                            <option value="1">Dia Regular</option>
                            <option value="2">Sabado o Domingo</option>
                            <option value="3">Festivo</option>
                            <option value="4">Otro</option>
                            <option value="5">Sin servicio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hora Inicio:</label><br>
                        <label for="hora_inicio">Hora:</label>
                        <select id="hora_inicio" name="hora_inicio" class="form-control" required>
                            <?php
                            for ($i = 8; $i < 25; $i++) {
                                printf('<option value="%02d">%02d</option>', $i, $i);
                            }
                            ?>
                        </select>
                        <label for="min_inicio">Min:</label>
                        <select id="min_inicio" name="min_inicio" class="form-control" required>
                            <option value="00">0</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hora_fin">Hora Fin:</label><br>
                        <label for="hora_fin">Hora:</label>
                        <select id="hora_fin" name="hora_fin" class="form-control" required>
                            <?php
                            for ($i = 8; $i < 25; $i++) {
                                printf('<option value="%02d">%02d</option>', $i, $i);
                            }
                            ?>
                        </select>
                        <label for="min_fin">Min:</label>
                        <select id="min_fin" name="min_fin" class="form-control" required>
                            <option value="00">0</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar Día</button>
                </form>

                <!-- Listado de días festivos y otros días -->
                <h2 class="mt-4">Días Festivos y Otros</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($dias)) {
                            foreach ($dias as $dia) {
                                $fecha = new DateTime($dia['fecha']);
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($fecha->format('d/m/Y')) . "</td>";
                                echo "<td>" . ($dia['id_horario'] == 3 ? 'Festivo' : 'Otro') . "</td>";
                                echo "<td>" . htmlspecialchars($dia['hora_inicio']) . "</td>";
                                echo "<td>" . htmlspecialchars($dia['hora_fin']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay días registrados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <?php require_once "./footer.php"; ?>
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