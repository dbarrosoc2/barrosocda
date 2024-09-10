<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$title = $_SESSION['nombre'];
require '../common/head.php';
require '../common/headerIniciado.php';
require './conexion.php';
require './Logs.php';
$logs = new Logger();
$logs->navegacion($_SESSION['usuario'], $_SERVER['REQUEST_URI'], $_SERVER['REMOTE_ADDR'], "Navegacion a Pagina Listado Cursos");
unset($_SESSION['nombre_corto_curso']);
unset($_SESSION['horarios_curso']);
unset($_SESSION['nombre_curso']);
if (isset($_SESSION['id_curso'])) {
    $_SESSION['id_curso'] = null;
}
// Variable para almacenar el valor de búsqueda
$busqueda = "";

if (isset($_GET['buscar'])) {
    $busqueda = trim($_GET['buscar']);
    // Query para filtrar los cursos por nombre
    $sql = "SELECT * FROM curso WHERE descripcion_curso LIKE ? ORDER BY id_curso DESC";
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute(["%$busqueda%"]);
    // Obtener todos los resultados como un array asociativo
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si no se ha realizado una búsqueda, mostrar todos los cursos
    $sql = "SELECT * FROM curso ORDER BY id_curso DESC";
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener todos los resultados como un array asociativo
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

?>

<body>
    <div class="container mt-4">
        <!-- Formulario de búsqueda -->
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar por nombre de curso" name="buscar"
                    value="<?php echo htmlspecialchars($busqueda); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <!-- Fin del formulario de búsqueda -->

        <h2>Listado de Cursos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Corto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $alternate = true;
                foreach ($cursos as $curso): ?>
                    <tr class="<?php echo $alternate ? 'table-primary' : 'table-secondary'; ?> clickable-row"
                        data-id="<?php echo $curso['id_curso']; ?>"
                        data-nombre="<?php echo htmlspecialchars($curso['descripcion_curso']); ?>"
                        data-horario="<?php echo htmlspecialchars($curso['horarios']); ?>"
                        data-nombre-corto="<?php echo htmlspecialchars($curso['nombre_corto']); ?>">
                        <td>
                            <?php echo $curso['id_curso']; ?>
                        </td>
                        <td>
                            <?php echo $curso['nombre_corto']; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($curso['descripcion_curso']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($curso['horarios']); ?>
                        </td>
                    </tr>
                    <?php
                    $alternate = !$alternate;
                endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require '../common/footer.php'; ?>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var rows = document.querySelectorAll("tr.clickable-row");

        rows.forEach(function (row) {
            row.addEventListener("click", function () {
                var idCurso = row.getAttribute("data-id");
                var nombreCurso = row.getAttribute("data-nombre");
                var horarioCurso = row.getAttribute("data-horario");
                var nombreCorto = row.getAttribute("data-nombre-corto");

                var url = "selecionDeParticipantes.php?id_curso=" + idCurso + "&nombreCurso=" + encodeURIComponent(nombreCurso) + "&horarioCurso=" + encodeURIComponent(horarioCurso) + "&nombreCorto=" + encodeURIComponent(nombreCorto);

                window.location.href = url;
            });
        });
    });
</script>

</html>