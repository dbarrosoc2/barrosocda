<?php
session_start();
$title = "Visualizar Citas";
require_once "./head.php";
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 2rem;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Estilo para reducir la imagen al 70% */
    .sin-resultados img {
        width: 10rem;
    }
</style>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    require_once "./Citas.php";

    // Obtener la fecha seleccionada del formulario
    $fechaSeleccionada = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1>Consultar Citas</h1>
                <form method="get" action="">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Seleccionar fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                            value="<?php echo $fechaSeleccionada; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>

                <?php
                // Crear instancia de la clase Citas
                $cita = new Citas();

                // Llamar al método listarCitas con la fecha seleccionada
                $citasPorMaquina = $cita->listarCitas($fechaSeleccionada); // Pasar la fecha seleccionada
                
                // Verificar si hay resultados
                $hayResultados = !empty($citasPorMaquina);

                // Si hay resultados, mostrar la tabla de citas
                if ($hayResultados) {
                    foreach ($citasPorMaquina as $id_maquina => $citas) {
                        // Obtener la descripción del día y la fecha en formato d/m/a
                

                        // Mostrar la indicación de la fecha y la descripción del día
                        echo "<table border='1'>";
                        echo "<tr>
                                <th>ID Donante</th>
                                <th>Apto</th>
                                <th>Hora Inicio (Cita)</th>
                                <th>Nombre Donante</th>
                                <!-- Añadir más columnas según las columnas de la tabla donante -->
                                <th>Acciones</th>
                              </tr>";

                        foreach ($citas as $cita) {
                            echo "<tr>                                     
                                    <td>{$cita['id_donante']}</td>
                                    <td>{$cita['apto']}</td>
                                    <td>{$cita['cita_hora_inicio']}</td>
                                    <td>{$cita['nombre']}</td>
                                    <!-- Añadir más columnas según las columnas de la tabla donante -->
                                    <!-- Botones de acciones -->
                                    <td>
                                        <a href='#' onclick='confirmarEliminar({$cita["id_cita"]}, \"" . $fechaSeleccionada . "\")' class='btn btn-danger'><i class='bi bi-trash'></i></a>
                                        <a href='editar_cita.php?id={$cita["id_cita"]}&fecha={$fechaSeleccionada}' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                                    </td>
                                  </tr>";
                        }
                    }
                } else {
                    // Si no hay resultados, mostrar la imagen y el mensaje
                    echo '<div class="text-center sin-resultados"><img src="SinResultados.jpg" alt="Sin resultados"></div>';
                    echo "<p class='text-center'>No se encontraron citas para la fecha especificada.</p>";
                }
                ?>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        function confirmarEliminar(idCita, fechaSeleccionada) {
            if (confirm('¿Estás seguro de que deseas borrar esta cita?')) {
                window.location.href = 'borrar_cita.php?id=' + idCita + '&fecha=' + fechaSeleccionada;
            }
        }
    </script>
</body>

</html>