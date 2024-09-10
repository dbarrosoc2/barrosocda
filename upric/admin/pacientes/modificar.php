<?php
include '../../common/session-checker.php';
require_once "../../controllers/POO/CLASS/Permisos.php";
require_once "../../controllers/POO/CLASS/Paciente.php";

$title = "Modificar Paciente";
$description = "Editar datos personales de paciente";
$panelAdmin = true;

$database = new Paciente();
$permisos = new Permisos();
$numPermiso = $_SESSION['permiso'];

if (isset($_GET['id_paciente'])) {
    if (!empty($_GET['id_paciente'])) {
        $id = $_GET['id_paciente'];
        $datosPaciente = $database->obtenerPacientePorNumRegistro($id);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <?php require_once __DIR__ . '/../../common/head.php'; ?>
<body>
    <?php include '../../common/header.php';    ?>
    <?php include '../../common/sidebar.php'; ?>

    <main id="main">
        <?php include '../../common/page-title.php'; ?>

        <?php
        if (isset($datosPaciente) && $datosPaciente) {
        ?>
            <div class="card">
                <div class="card-body">
                    <form class="row g-4 needs-validation" novalidate action="../../controllers/POO/paciente-editar.php" method="post">
                        <input type="hidden" name="id_paciente" value="<?= $datosPaciente['id_paciente']; ?>">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" value="<?= htmlspecialchars($datosPaciente['dni']);  ?>" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="50" required>
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['nombre']);  ?>" id="nombre" placeholder="Nombre" name="nombre" required>
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['nombre2']);  ?>" id="nombre2" placeholder="2do Nombre" name="nombre2">
                                <label for="nombre">2do Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['apellido']);  ?>" id="apellido" placeholder="Apellido" name="apellido" required>
                                <label for="apellido2">1er Apellido</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['apellido2']);  ?>" id="apellido2" placeholder="2do Apellido" name="apellido2" required>
                                <label for="apellido2">2er Apellido</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" value="<?= htmlspecialchars($datosPaciente['telefono']);  ?>" id="telefono" name="telefono" placeholder="Teléfono" minlength="6" required>
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" value="<?= htmlspecialchars($datosPaciente['fecha_nac']);  ?>" id="fecha_nac" name="fecha_nac" placeholder="Fecha Nac." required>
                                <label for="fecha_nac">Fecha Nac.</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="estado" value="<?= htmlspecialchars($datosPaciente['estado']);  ?>" name="estado" placeholder="Estado" required>
                                <label for="estado">Estado</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['municipio']);  ?>" id="municipio" name="municipio" placeholder="Municipio" required>
                                <label for="municipio">Municipio</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['parroquia']);  ?>" id="parroquia" name="parroquia" placeholder="Parroquia" required>
                                <label for="parroquia">Parroquia</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="calle" value="<?= htmlspecialchars($datosPaciente['calle']);  ?>" name="calle" placeholder="Calle" required>
                                <label for="calle">Calle</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['resto']);  ?>" id="resto" name="resto" placeholder="Resto" required>
                                <label for="resto">Resto</label>
                            </div>
                        </div>
                        <div class="col-md-2 confirmatorio-select">
                            <label for="confirmatorio">Confirmatorio</label>
                            <div class="form-check__horizontal d-flex mt-2">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="confirmatorio" id="confirmatorio_no" value="0" <?= $datosPaciente['confirmatorio'] === 0 ? "checked" : ""  ?>>
                                    <label class="form-check-label" for="confirmatorio_no">No</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="confirmatorio" id="confirmatorio_si" value="1" <?= $datosPaciente['confirmatorio'] === 1 ? "checked" : ""  ?>>
                                    <label class="form-check-label" for="confirmatorio_si">Si</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4  confirmatorio-fecha <?= $datosPaciente['confirmatorio'] === 0 ? "d-none" : ""  ?>">
                            <div class="form-floating">
                                <input type="date" class="form-control" value="<?= htmlspecialchars($datosPaciente['fecha_confirmatorio']);  ?>" id="fecha_confirmatorio" name="fecha_confirmatorio" placeholder="Fecha Confirmatorio">
                                <label for="fecha_confirmatorio">Fecha Confirmatorio</label>
                            </div>
                        </div>
                        <div class="confirmatorio-hospital <?= $datosPaciente['confirmatorio'] === 0 ? "col-md-10" : "col-md-6"  ?>">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($datosPaciente['hosp_ref']);  ?>" id="hosp_ref" name="hosp_ref" placeholder="Hospital de Referencia" required>
                                <label for="hosp_ref">Hospital de Referencia</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario (Opcional)" rows="5"><?= htmlspecialchars($datosPaciente['comentario']);  ?></textarea>
                                <label for="comentario">Comentario (Opcional)</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary" name="modificar_submit">Actualizar datos</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        } else {
            echo "<p>No se encontró el paciente.</p>";
        }
        ?>

    </main>

    <?php
        $customScript = "pacientes.js";
        require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>
</html>