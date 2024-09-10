<?php
include '../../common/session-checker.php';
require_once "../../controllers/POO/CLASS/Paciente.php";
require_once "../../controllers/POO/CLASS/funciones.php";
require_once "../../controllers/POO/CLASS/Permisos.php";
$title = "Consultar Paciente";
$description = "Buscar pacientes por sus datos en UPRIC";
$panelAdmin = true;
$permisos = new Permisos();
$numPermiso = $_SESSION['permiso'];
   
?>

<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';  ?>
    <?php include '../../common/sidebar.php'; ?>


    <main id="main" class="main">
    <?php
                if ($permisos->verificarPermisosAdministrativo($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>
        <?php include '../../common/page-title.php'; ?>

        <div class="card">
            <div class="card-body">
                <form class="row g-4 needs-validation" novalidate action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Busca por DNI, ID, Teléfono, Nombres o Apellidos" name="busqueda" required>
                            <label for="busqueda">Buscar por DNI, ID, Teléfono, Nombres o Apellidos</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary me-3 btnFormRestart">Restablecer</button>
                        <button type="submit" class="btn btn-primary" name="submit">Buscar paciente</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            // Limpiar el valor enviado
            $busqueda = limpiar($_POST['busqueda']);
            $paciente = new Paciente();
            $pacientesBusquedaData = $paciente->consultarPaciente($busqueda);
        ?>
            <div class="card listPacientes">
                <div class="card-body">
                    <?php if (count($pacientesBusquedaData) > 0) { ?>
                        <?php
                        $modalPreguntaTitle = "Eliminar paciente";
                        $modalPreguntaDescription = '¿Estás de acuerdo con eliminar al paciente <strong class="deleteName">Test</strong>? Esta operación no puede revertirse.';
                        include '../../common/modal-pregunta.php';
                        ?>
                        <h5 class="card-title">Resultados de pacientes con la búsqueda <i><?= $busqueda ?></i></h5>
                        <table class="table table-result">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>#ID</th>
                                    <th>DNI</th>
                                    <th>Teléfono</th>
                                    <th class="buttons"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pacientesBusquedaData as $paciente) { ?>
                                    <tr data-delete-row-id="<?=$paciente['id_paciente']?>">
                                        <td class="row-name">
                                            <span class="nombres"><?= "{$paciente['nombre']}  {$paciente['nombre2']}" ?></span>
                                            <span class="apellidos"><?= "{$paciente['apellido']}  {$paciente['apellido2']}" ?></span>
                                        </td>
                                        <td><?= $paciente['id_paciente'] ?></td>
                                        <td><?= $paciente['dni'] ?></td>
                                        <td><?= $paciente['telefono'] ?></td>
                                        <td class="row-buttons">
                                            <div class="d-flex">
                                                <a href="modificar.php?id_paciente=<?= $paciente['id_paciente'] ?>" class="btn btn-outline-primary me-3">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>

                                                <button class="btn btn-outline-primary btnDelete" data-delete-id="<?= $paciente['id_paciente'] ?>" data-delete-name="<?= $paciente['nombre'] . " " . $paciente['apellido'] ?>" data-delete-url="../../controllers/POO/borrar-paciente-funcion.php" data-delete-type="paciente">
                                                    <i class="bi bi-trash-fill" data-delete-id="<?= $paciente['id_paciente'] ?>" data-delete-name="<?= $paciente['nombre'] . " " . $paciente['apellido'] ?>" data-delete-url="../../controllers/POO/borrar-paciente-funcion.php" data-delete-type="paciente"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class='alert alert-warning' role='alert'><i class='bi bi-exclamation-triangle'></i> No existen pacientes con esta búsqueda.</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </main>


    <?php
    if (isset($_SESSION['mensaje'])) {
        $modalTitle = "¡Paciente actualizado!";
        $modalDescription = "Los datos del paciente <strong>{$_SESSION['mensaje']}</strong> fueron actualizados correctamente.";
        include '../../common/modal-success.php';
    } elseif (isset($_SESSION['error'])) {
        echo "{$_SESSION['error']}";
    }
    unset($_SESSION['mensaje']);
    unset($_SESSION['error']);
    ?>

    <?php
    $customScript = "pacientes.js";
    require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>

</html>