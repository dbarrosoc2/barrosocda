<?php
    include '../../common/session-checker.php';
    require_once "../../controllers/POO/CLASS/Paciente.php";
    require_once "../../controllers/POO/CLASS/funciones.php";
    require_once "../../controllers/POO/CLASS/Permisos.php";

    $title = "Alta Paciente";
    $description = "Registrar pacientes en UPRIC";
    $panelAdmin = true;
    $permisos = new Permisos();
    $numPermiso = $_SESSION['permiso'];
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';    ?>
    <?php include '../../common/sidebar.php'; ?>

    <main id="main">
        <?php include '../../common/page-title.php'; ?>
        <div class="card">
            <div class="card-body">
                <?php
                if ($permisos->verificarPermisosAdministrativo($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>
                <form class="row g-4 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" value="<?= isset($dni) ? $dni : ""  ?>" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="50" required>
                            <label for="dni">DNI</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($nombre) ? $nombre :  '' ?>" id="nombre" placeholder="Nombre" name="nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($nombre2) ? $nombre2 :  '' ?>" id="nombre2" placeholder="2do Nombre" name="nombre2">
                            <label for="nombre2">2do Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($apellido) ? $apellido :  '' ?>" id="apellido" placeholder="Apellido" name="apellido" required>
                            <label for="apellido2">1er Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($apellido2) ? $apellido2 :  '' ?>" id="apellido2" placeholder="2do Apellido" name="apellido2" required>
                            <label for="apellido2">2er Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="tel" class="form-control" value="<?= isset($telefono) ? $telefono : '' ?>" id="telefono" name="telefono" placeholder="Teléfono" required>
                            <label for="telefono">Teléfono</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control" value="<?= isset($fecha_nacimiento) ? $fecha_nacimiento : '' ?>" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nac." required>
                            <label for="fecha_nacimiento">Fecha Nac.</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="estado" value="<?= isset($estado) ? $estado : '' ?>" name="estado" placeholder="Estado" required>
                            <label for="estado">Estado</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($municipio) ? $municipio : '' ?>" id="municipio" name="municipio" placeholder="Municipio" required>
                            <label for="municipio">Municipio</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($parroquia) ? $parroquia : '' ?>" id="parroquia" name="parroquia" placeholder="Parroquia" required>
                            <label for="parroquia">Parroquia</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="calle" value="<?= isset($calle) ? $calle : '' ?>" name="calle" placeholder="Calle" required>
                            <label for="calle">Calle</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($resto) ? $resto : '' ?>" id="resto" name="resto" placeholder="Resto" required>
                            <label for="resto">Resto</label>
                        </div>
                    </div>
                    <div class="col-md-2 confirmatorio-select">
                        <label for="confirmatorio">Confirmatorio</label>
                        <div class="form-check__horizontal d-flex mt-2">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="confirmatorio" id="confirmatorio_no" value="0" checked>
                                <label class="form-check-label" for="confirmatorio_no">No</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="confirmatorio" id="confirmatorio_si" value="1">
                                <label class="form-check-label" for="confirmatorio_si">Si</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-none confirmatorio-fecha">
                        <div class="form-floating">
                            <input type="date" class="form-control" value="<?= isset($fecha_confirmatorio) ? $fecha_confirmatorio : '' ?>" id="fecha_confirmatorio" name="fecha_confirmatorio" placeholder="Fecha Confirmatorio">
                            <label for="fecha_confirmatorio">Fecha Confirmatorio</label>
                        </div>
                    </div>
                    <div class="col-md-10 confirmatorio-hospital">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?= isset($hospital_referencia) ? $hospital_referencia : '' ?>" id="hospital_referencia" name="hospital_referencia" placeholder="Hospital de Referencia" required>
                            <label for="hospital_referencia">Hospital de Referencia</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="comentario" value="<?= isset($comentario) ? $comentario : '' ?>" name="comentario" placeholder="Comentario (Opcional)" rows="5"></textarea>
                            <label for="comentario">Comentario (Opcional)</label>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="submit">Dar de alta a paciente</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

            $dni = isset($_POST['dni']) ? limpiar($_POST['dni']) : '';
            $nombre = isset($_POST['nombre']) ? limpiar($_POST['nombre']) : '';
            $nombre2 = isset($_POST['nombre2']) ? limpiar($_POST['nombre2']) : '';
            $apellido = isset($_POST['apellido']) ? limpiar($_POST['apellido']) : '';
            $apellido2 = isset($_POST['apellido2']) ? limpiar($_POST['apellido2']) : '';
            $confirmatorio = isset($_POST['confirmatorio']) ? limpiar($_POST['confirmatorio']) : '';
            $fecha_confirmatorio = isset($_POST['fecha_confirmatorio']) ? limpiar($_POST['fecha_confirmatorio']) : '';
            $telefono = isset($_POST['telefono']) ? limpiar($_POST['telefono']) : '';
            $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? limpiar($_POST['fecha_nacimiento']) : '';
            $estado = isset($_POST['estado']) ? limpiar($_POST['estado']) : '';
            $municipio = isset($_POST['municipio']) ? limpiar($_POST['municipio']) : '';
            $parroquia = isset($_POST['parroquia']) ? limpiar($_POST['parroquia']) : '';
            $calle = isset($_POST['calle']) ? limpiar($_POST['calle']) : '';
            $resto = isset($_POST['resto']) ? limpiar($_POST['resto']) : '';
            $hospital_referencia = isset($_POST['hospital_referencia']) ? limpiar($_POST['hospital_referencia']) : '';
            $comentario = isset($_POST['comentario']) ? limpiar($_POST['comentario']) : '';

            // Crear una instancia de la clase Paciente
            $database = new Paciente();
            $pacienteCreadoData = $database->crearPaciente($dni, $nombre, $nombre2, $apellido, $apellido2, $confirmatorio, $fecha_confirmatorio, $telefono, $fecha_nacimiento, $estado, $municipio, $parroquia, $calle, $resto, $hospital_referencia, $comentario);

            $modalTitle = "¡Nuevo paciente creado!";
            $modalDescription = "El paciente <strong>{$pacienteCreadoData['nombre']} {$pacienteCreadoData['apellido']}</strong> con DNI {$pacienteCreadoData['dni']} y teléfono {$pacienteCreadoData['telefono']}, fue registrado correctamente.";
            include '../../common/modal-success.php';
        }
        ?>
    </main>
    <?php
        $customScript = "pacientes.js";
        require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>

</html>