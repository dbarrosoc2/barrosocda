<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


// Incluir el archivo de encabezado común
$title = "Selección de Participantes"; // Título de la página
require '../common/head.php'; // Encabezado de la página HTML
require '../common/headerIniciado.php'; // Encabezado de la página HTML
require './conexion.php'; // Conexión a la base de datos
require './Logs.php'; // Clase de registro de registros

// Crear una instancia de la clase de registro de registros
$logs = new Logger();
$logs->navegacion($_SESSION['usuario'], $_SERVER['REQUEST_URI'], $_SERVER['REMOTE_ADDR'], "Nav a Página de Selección de Participa");

// Obtener el ID del curso de la URL, si está presente
if (isset($_GET['id_curso']) && !empty($_GET['id_curso'])) {
    $id = trim(htmlspecialchars($_GET['id_curso']));
    $_SESSION['id_curso'] = $id; // Almacenar el ID del curso en la sesión
} elseif (!empty($_SESSION['id_curso'])) {
    $id = $_SESSION['id_curso']; // Obtener el ID del curso de la sesión
} else {
    // No se proporcionó el ID del curso ni está almacenado en la sesión
    // Puedes manejar esta situación según tus necesidades
    // Por ejemplo, redirigir a una página de error o establecer un valor predeterminado
}

// Obtener el nombre del curso de la URL, si está presente
if (isset($_GET['nombreCurso']) && !empty($_GET['nombreCurso'])) {
    $nombreCurso = trim(htmlspecialchars($_GET['nombreCurso']));
    $_SESSION['nombre_curso'] = $nombreCurso; // Almacenar el nombre del curso en la sesión
} elseif (!empty($_SESSION['nombre_curso'])) {
    $nombreCurso = $_SESSION['nombre_curso']; // Obtener el nombre del curso de la sesión
} else {
    $nombreCurso = null;
}


// Obtener los horarios del curso de la URL, si están presentes
$horarios = isset($_GET['horarioCurso']) ? trim(htmlspecialchars($_GET['horarioCurso'])) : null;

// Verificar si los horarios del curso están en la sesión y no están en la URL
if (empty($horarios) && isset($_SESSION['horarios_curso'])) {
    $horarios = $_SESSION['horarios_curso'];
}

// Si los horarios del curso se establecen en la URL, guárdalos en la sesión
if (!empty($horarios)) {
    $_SESSION['horarios_curso'] = $horarios;
}


// Obtener el nombre corto del curso de la URL, si está presente
$nombreCorto = isset($_GET['nombreCorto']) ? trim(htmlspecialchars($_GET['nombreCorto'])) : null;

// Verificar si el nombre corto del curso está en la sesión y no está en la URL
if (empty($nombreCorto) && isset($_SESSION['nombre_corto_curso'])) {
    $nombreCorto = $_SESSION['nombre_corto_curso'];
}

// Si el nombre corto del curso se establece en la URL, guardarlo en la sesión
if (!empty($nombreCorto)) {
    $_SESSION['nombre_corto_curso'] = $nombreCorto;
}


// Verificar si se envió un término de búsqueda
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    // Si se envió, preparar la cadena de búsqueda
    $busqueda = '%' . trim($_GET['busqueda']) . '%';
    // Modificar la consulta SQL para incluir la condición de búsqueda
    $sql = "SELECT 
    sc.*, 
    (SELECT MAX(fechaEnvio) FROM certificados WHERE id_solicitud = sc.id_solicitud) AS fecha_certificado,
    (SELECT confirma FROM confirmacion WHERE id_solicitud = sc.id_solicitud ORDER BY fecha_confirmacion DESC LIMIT 1) AS ultima_confirmacion,
    m.fechaEnvio AS mensaje
FROM 
    solicitud_curso sc
LEFT JOIN 
    mensajes m ON sc.id_solicitud = m.id_solicitud
WHERE 
    sc.id_curso = :id AND 
    (
        sc.nombre LIKE :busqueda OR 
        sc.apellido1 LIKE :busqueda OR 
        sc.apellido2 LIKE :busqueda OR 
        sc.telefono LIKE :busqueda OR 
        sc.id_empleado_salud LIKE :busqueda OR 
        sc.email LIKE :busqueda OR 
        sc.categoria LIKE :busqueda
    )
GROUP BY 
    sc.id_solicitud
ORDER BY 
    fecha_certificado DESC,
    m.fechaEnvio DESC";

} else {
    // Si no se envió un término de búsqueda, ejecutar la consulta sin filtrar
    $sql = "SELECT 
    sc.*, 
    (SELECT MAX(fechaEnvio) FROM certificados WHERE id_solicitud = sc.id_solicitud) AS fecha_certificado,
    (SELECT confirma FROM confirmacion WHERE id_solicitud = sc.id_solicitud ORDER BY fecha_confirmacion DESC LIMIT 1) AS ultima_confirmacion,
    m.fechaEnvio AS mensaje
FROM 
    solicitud_curso sc
LEFT JOIN 
    mensajes m ON sc.id_solicitud = m.id_solicitud
WHERE 
    sc.id_curso = :id
GROUP BY 
    sc.id_solicitud
ORDER BY 
    fecha_certificado DESC,
    m.fechaEnvio DESC";

}



// Preparar la consulta SQL
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
if (isset($busqueda)) {
    $stmt->bindParam(':busqueda', $busqueda);
}
$stmt->execute();

// Obtener todos los resultados como un array asociativo
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Procesar la solicitud de admisión de participantes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["admitir_participantes"])) {
    // Verificar si se seleccionaron participantes
    if (isset($_POST["seleccionar_participante"]) && (!empty($_POST["seleccionar_participante"]))) {
        // Obtener los números de solicitud seleccionados
        $numeros_solicitud = $_POST["seleccionar_participante"];
        $id_curso = $_SESSION['id_curso'];
        // Redirigir a la página de procesamiento con los números de solicitud y el ID del curso
        header("Location: procesar_admision.php?numeros_solicitud=" . urlencode(implode(',', $numeros_solicitud)) . "&nombre_corto_curso=" . urlencode($nombreCorto) . "&id_curso=" . urlencode($id_curso));
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["revocar_participantes"])) {
    // Verificar si se seleccionaron participantes
    if (isset($_POST["seleccionar_participante"]) && (!empty($_POST["seleccionar_participante"]))) {
        // Obtener los números de solicitud seleccionados
        $numeros_solicitud = $_POST["seleccionar_participante"];
        $id_curso = $_SESSION['id_curso'];
        // Redirigir a la página de procesamiento con los números de solicitud y el ID del curso
        header("Location: procesar_revocar_admision.php?numeros_solicitud=" . urlencode(implode(',', $numeros_solicitud)) . "&nombre_corto_curso=" . urlencode($nombreCorto) . "&id_curso=" . urlencode($id_curso));
        exit();
    }
}

// Procesar el envio SMS confirmacion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["envio_noti"])) {
    // Verificar si se seleccionaron participantes
    if (isset($_POST["seleccionar_participante"]) && (!empty($_POST["seleccionar_participante"]))) {
        // Obtener los números de solicitud seleccionados
        $numeros_solicitud = $_POST["seleccionar_participante"];
        $nombre_solicitante = $_POST["seleccionar_participante"];
        // $nombre_solicitante = $_POST[];
        $id_curso = $_SESSION['id_curso'];


        // Redirigir a la página de procesamiento con los números de solicitud y el ID del curso
        header("Location: envioSMS.php?numeros_solicitud=" . urlencode(implode(',', $numeros_solicitud)) . "&nombre_corto_curso=" . urlencode($nombreCorto) . "&id_curso=" . urlencode($id_curso) . "&id_curso" . urldecode(implode(',', $nombre_solicitante)));
        exit();
    }
}
?>

<!-- Estilos CSS para la página -->
<style>
    /* Estilos para la sección y el aside */
    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    aside {
        width: 15%;
        height: 90%;
        background-color: #f8f9fa;
        padding: 20px;
        position: fixed;
        top: 100px;
        left: 0;
        overflow-y: auto;
    }

    aside button {
        width: 100%;
        margin-bottom: 10px;
    }

    section {
        margin-left: 1%;
        width: 100%;
        height: 90%;
        padding: 20px;
        overflow-y: auto;
    }

    /* Estilos para el footer */
    footer {
        position: relative;
        bottom: 0;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
    }

    th {
        white-space: nowrap;
        /* Evitar el salto de línea */
    }

    /* Estilos para los íconos de ordenación */
    .fa-sort {
        vertical-align: middle;
        /* Alinear verticalmente con el texto */
        margin-left: 5px;
        /* Espacio a la izquierda del ícono */
    }

    ul {
        margin: 10px 0;
        padding: 0;
        list-style: none;
    }

    ul li {
        margin-bottom: 5px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #e0e0e0;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th,
    td {
        text-align: center;
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 15%;
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 40%;
    }

    th:nth-child(4),
    td:nth-child(4) {
        width: 30%;
    }
</style>

<!-- Cuerpo de la página HTML -->

<body>
    <!-- Sección principal de la página -->
    <section>
        <div class="container mt-5">
            <!-- Encabezado -->
            <h2>Listado de Empleados solicitantes del curso:<br>
                sesion nombre corto:
                <?php
                echo $_SESSION['nombre_corto_curso'];
                echo isset($nombreCurso) ? $nombreCurso : '';
                ?>

            </h2>
            <div>
                <h3>
                    <div>
                        <!-- Enlace para editar el nombre corto del curso -->
                        <a href="?id_curso=<?php echo $id; ?>&nombreCurso=<?php echo urlencode($nombreCurso); ?>&nombreCorto=<?php echo urlencode($nombreCorto); ?>&horarioCurso=<?php echo urlencode($horarios); ?>&edit_id=<?php echo $id; ?>"
                            class="btn btn-info btn-sm">Editar nombre Corto</a>
                        <!-- Mostrar el nombre corto del curso si está definido -->
                        <?php if (isset($nombreCorto)): ?>
                            <?php echo htmlspecialchars($nombreCorto); ?>
                        <?php else: ?>
                            Sin nombre corto
                        <?php endif; ?>
                    </div>
                </h3>
            </div>
            <!-- Formulario para editar el nombre corto del curso -->
            <?php if (isset($_GET['edit_id'])): ?>
                <div>
                    <form
                        action="AsignarNombreCorto.php?id=<?php echo $id; ?>&nombreCurso=<?php echo urlencode($nombreCurso); ?>&nombreCorto=<?php echo urlencode($nombreCorto); ?>&horarioCurso=<?php echo urlencode($horarios); ?>&edit_id=<?php echo $id; ?>"
                        method="POST">
                        <label for="nombre_corto">Nombre Corto (Máximo 63 caracteres):</label>
                        <input type="text" id="nombre_corto" name="nombre_corto"
                            value="<?php echo isset($nombreCorto) ? htmlspecialchars($nombreCorto) : ''; ?>"
                            class="form-control" maxlength="63">
                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    </form>
                </div>
            <?php endif; ?>
            <!-- Formulario de búsqueda -->
            <form action="" method="GET" class="mb-3">
                <div class="form-group">
                    <label for="busqueda">Filtar:</label>
                    <input type="text" class="form-control" id="busqueda" name="busqueda"
                        placeholder="Puedes buscar por nombre, apellidos, correo electronico, telefono o categoria">
                    <!-- Incluir los valores de id_curso y nombreCurso como campos ocultos en el formulario -->
                    <input type="hidden" name="id_curso" value="<?php echo isset($id) ? $id : ''; ?>">
                    <input type="hidden" name="nombreCurso"
                        value="<?php echo isset($nombreCurso) ? $nombreCurso : ''; ?>">
                    <input type="hidden" name="horarioCurso" value="<?php echo isset($horarios) ? $horarios : ''; ?>">
                    <input type="hidden" name="nombreCorto"
                        value="<?php echo isset($nombreCorto) ? $nombreCorto : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            <!-- Resto del contenido de la página -->
            <!-- Botones para seleccionar/deseleccionar todos -->
            <!-- <div class="mb-3">
                <button id="seleccionarTodos" class="btn btn-primary">Seleccionar Todos</button>
                <button id="deseleccionarTodos" class="btn btn-secondary">Deseleccionar Todos</button>
            </div> -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="submit" name="envio_noti" class="btn btn-success" value="Enviar Notificación del Curso">
                <input type="submit" name="revocar_participantes" class="btn btn-danger"
                    value="Revocar Participantes admitidos">
                <input type="submit" name="admitir_participantes" class="btn btn-primary"
                    value="Admitir Participantes Seleccionados">

                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="check"></div>
                            </th>
                            <!-- <th>ID Solicitud</th> -->
                            <!-- <th>ID HDOC</th> -->
                            <th>
                                <div>
                                    ID SALUD <i class="fas fa-sort" style="margin-left: 5px;"></i>
                                </div>
                            </th>
                            <th>
                                <div>
                                    Datos del solicitante <i class="fas fa-sort" style="margin-left: 5px;"></i>
                                </div>
                            </th>
                            <th>
                                <div>
                                    Datos del proceso de seleccion <i class="fas fa-sort" style="margin-left: 5px;"></i>
                                </div>
                            </th>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT fechaEnvio from certificados WHERE id_solicitud = ";
                        $alternate = true;
                        foreach ($cursos as $curso): ?>
                            <tr class="<?php echo $alternate ? 'table-primary' : 'table-secondary'; ?>">
                                <td>
                                    <!-- Checkbox para seleccionar al participante -->
                                    <input type="checkbox" class="seleccionar_participante"
                                        name="seleccionar_participante[]" value="<?php echo $curso['id_solicitud']; ?>">
                                </td>
                                <!-- <td>
                <?php
                //echo $curso['id_solicitud'];
                ?>
            </td> -->
                                <!-- <td>
                <?php
                // echo $curso['id_empleado_hdoc'];
                ?>
            </td> -->
                                <td class="id_empleado_salud">
                                    <?php echo htmlspecialchars($curso['id_empleado_salud']); ?>
                                </td>
                                <td>
                                    <ul>
                                        <li><strong>Categoría:</strong>
                                            <?php
                                            if (isset($curso['categoria'])) {
                                                echo $curso['categoria'];
                                            } else {
                                                echo "Categoría no definida";
                                            }
                                            ?>
                                        </li>
                                        <li><strong>Nombre:</strong>
                                            <?php echo htmlspecialchars($curso['nombre']); ?>
                                        </li>
                                        <li><strong>Apellidos:</strong>
                                            <?php echo htmlspecialchars($curso['apellido1']) . " " . htmlspecialchars($curso['apellido2']); ?>
                                        </li>
                                        <li><strong>Teléfono:</strong>
                                            <?php echo $curso['telefono']; ?>
                                        </li>
                                        <li><strong>Email:</strong>
                                            <?php echo htmlspecialchars($curso['email']); ?>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li><strong>Admitido:</strong>
                                            <?php
                                            if (($curso['admitido']) == 'null' || (empty($curso['admitido']))) {
                                                echo "No";
                                            } else {
                                                echo $curso['admitido'];
                                            }
                                            ?>
                                        </li>
                                        <li><strong>Último envío:</strong>
                                            <?php if (!empty($curso['mensaje'])): ?>
                                                <?php echo $curso['mensaje']; ?>
                                                <div>
                                                    <!-- Enlace con el ID de solicitud como parámetro en la URL -->
                                                    <a href="detalleEnvioYConfirmacion.php?id_solicitud=<?php echo $curso['id_solicitud']; ?>"
                                                        target="_blank" class="etiqueta" data-target="#notificacionesCollapse">
                                                        <!-- Ajustar el tamaño de la imagen con estilos en línea -->
                                                        <img src="../public/istockphoto-845329690-612x612.jpg" alt="ojoDetalle"
                                                            style="width: 20px; height: 20px;">
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                Sin envío de notificación
                                            <?php endif; ?>
                                        </li>
                                        <li><strong>Confirma:</strong>
                                            <?php
                                            if (isset($curso['ultima_confirmacion'])) {
                                                echo $curso['ultima_confirmacion'];
                                                ?>
                                                <div>
                                                    <a href="detalleEnvioYConfirmacion.php?id_solicitud=<?php echo $curso['id_solicitud']; ?>"
                                                        class="etiqueta" data-target="#confirmacionesCollapse" target="_blank">
                                                        <img src="../public/istockphoto-845329690-612x612.jpg" alt="ojoDetalle"
                                                            style="width: 20px; height: 20px;">
                                                    </a>
                                                </div>
                                            <?php } else {
                                                echo "Sin registros";
                                            }
                                            ?>
                                        </li>
                                        <li><strong>Fecha certificado:</strong>
                                            <?php
                                            if (isset($curso['fecha_certificado'])) {
                                                echo $curso['fecha_certificado']; ?>
                                                <a href="detalleEnvioYConfirmacion.php?id_solicitud=<?php echo $curso['id_solicitud']; ?>"
                                                    target="_blank" class="etiqueta" data-target="#visualizacionesCollapse">
                                                    <!-- Ajustar el tamaño de la imagen con estilos en línea -->
                                                    <img src="../public/istockphoto-845329690-612x612.jpg" alt="ojoDetalle"
                                                        style="width: 20px; height: 20px;">
                                                </a>
                                                <?php
                                            } else {
                                                echo "No se ha enviado el certificado";
                                            }
                                            ?>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                            $alternate = !$alternate;
                        endforeach; ?>
                    </tbody>

                </table>
            </form>
        </div>
    </section>
    <!-- Aside de la página para acciones adicionales -->
    <!-- Aside de la página para acciones adicionales -->
    <!-- Aside de la página para acciones adicionales -->
    <!-- Aside de la página para acciones adicionales -->
    <!-- Aside de la página para acciones adicionales -->
    <!-- Aside de la página para acciones adicionales -->
    <aside>
        <div class="mb-3">
            <!-- Formulario del aside -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <!-- Botón para admitir participantes -->
                <!-- <button type="submit" name="admitir_participantes" class="btn btn-success">Admitir
                    Participantes</button>
                <button type="submit" class="btn btn-primary" name="envio_noti">Enviar Notificación del Curso</button> -->
                <!-- Campo oculto para almacenar el ID del curso -->
                <input type="hidden" name="id_curso" value="<?php echo isset($id) ? $id : ''; ?>">
            </form>
        </div>
        <!-- Sección para seleccionar/deseleccionar todos -->
        <div>
            <button id="seleccionarTodosAside" class="btn btn-warning">Seleccionar Todos</button>
            <button id="deseleccionarTodosAside" class="btn btn-secondary">Deseleccionar Todos</button>
        </div>
        <div>
            <a class="btn btn-info" href="./cursos.php">Volver a Cursos</a>
        </div>
    </aside>
    <!-- Incluir el pie de página común -->
    <!-- <?php require __DIR__ . '/../common/footer.php' ?> -->
</body>

<!-- Incluir JavaScript de Bootstrap y sus dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Función para manejar los botones de selección en el section
    $(document).ready(function () {
        // Manejar el botón "Seleccionar Todos"
        $('#seleccionarTodos').click(function () {
            $('.seleccionar_participante').prop('checked', true);
        });

        // Manejar el botón "Deseleccionar Todos"
        $('#deseleccionarTodos').click(function () {
            $('.seleccionar_participante').prop('checked', false);
        });
    });

    // Función para manejar los botones de selección en el aside
    $(document).ready(function () {
        // Manejar el botón "Seleccionar Todos" del aside
        $('#seleccionarTodosAside').click(function () {
            $('.seleccionar_participante').prop('checked', true);
        });

        // Manejar el botón "Deseleccionar Todos" del aside
        $('#deseleccionarTodosAside').click(function () {
            $('.seleccionar_participante').prop('checked', false);
        });
    });

    $(document).ready(function () {
        // Inicializar el estado de ordenación ascendente para todas las columnas
        $('th').each(function () {
            $(this).data('sorted', false);
        });

        // Manejar el clic en las celdas del encabezado
        $('th').click(function () {
            var table = $(this).parents('table').eq(0);
            var rows = table.find('tr:gt(0)').toArray();
            var index = $(this).index();

            // Obtener el estado de ordenación actual de la columna
            var sorted = $(this).data('sorted');

            // Ordenar las filas
            rows.sort(function (a, b) {
                var valA = $(a).find('td').eq(index).text().toUpperCase();
                var valB = $(b).find('td').eq(index).text().toUpperCase();
                // Determinar el orden según el estado actual de ordenación
                return sorted ? (valA < valB ? 1 : valA > valB ? -1 : 0) : (valA > valB ? 1 : valA < valB ? -1 : 0);
            });

            // Invertir el estado de ordenación para la columna actual
            $(this).data('sorted', !sorted);

            // Reorganizar las filas en la tabla
            $.each(rows, function (index, row) {
                table.append(row);
            });
        });
    });

</script>



</html>