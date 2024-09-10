<?php
    include '../../common/session-checker.php';
    require_once "../../controllers/POO/CLASS/Paciente.php";
    require_once "../../controllers/POO/CLASS/funciones.php";
    require_once "../../controllers/POO/CLASS/Prueba.php";
    require_once "../../controllers/POO/CLASS/Prueba-Paciente.php";
    require_once "../../controllers/POO/CLASS/Permisos.php";
    
    $title = "Asignar prueba a paciente";
    $description = "Asigna un tipo de prueba(s) a un paciente";
    $panelAdmin = true;
    $prueba = new Prueba();
    $paciente = new Paciente();
    $prueba_paciente = new Prueba_Paciente();
    $permisos = new Permisos();
    $numPermiso = $_SESSION['permiso'];
    $customStyle = "multiple-select.css";
    // Define variables para almacenar los datos del formulario después de limpiarlos
    $prueba_ids = $paciente_id = $fecha = $comentarios = "";

?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';    ?>
    <?php include '../../common/sidebar.php'; ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>

        <div class="card">
            <div class="card-body">
            <?php
                if ($permisos->verificarPermisosAdministrativo($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>
                <div class="row placeholderLoading">
                    <div class="col-md-12">
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                    </div>
                </div>
                <form class="row g-4 needs-validation d-none" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" name="prueba_id[]" id="prueba_id" aria-label="paciente" multiple multiselect-search="true" required>
                                <?php echo $prueba->obtenerOpcionesPruebasSelect(); ?>
                            </select>
                            <label for="prueba_id">Selecciona pruebas</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="paciente_id" name="paciente_id" aria-label="paciente" required>
                                <?php echo $paciente->listarPacientesParaSelect(); ?>
                            </select>
                            <label for="paciente_id">Selecciona un paciente</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="fecha" name="fecha" max="<?php echo date('Y-m-d'); ?>" required>
                            <label for="fecha">Fecha de la toma de muestra</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                            <label for="comentarios">Comentarios (Opcional)</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary me-3 btnFormRestart" >Restablecer</button>
                        <button type="submit" class="btn btn-primary" name="submit">Asignar pruebas</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
            // Verificar si se envió el formulario mediante el método POST
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Limpiar y guardar los datos en variables
                $prueba_ids = isset($_POST['prueba_id']) ? $_POST['prueba_id'] : [];
                $paciente_id = isset($_POST['paciente_id']) ? limpiar($_POST['paciente_id']) : '';
                $fecha = isset($_POST['fecha']) ? limpiar($_POST['fecha']) : date("Y-m-d");
                $comentarios = isset($_POST['comentarios']) ? limpiar($_POST['comentarios']) : '';
                $result = $prueba_paciente->ingresarDatosPacientePrueba($paciente_id, $prueba_ids, $comentarios, $fecha);

                foreach ($result["pruebas"] as $id_prueba => $datos) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        La prueba&nbsp; <strong><?=$datos?></strong> 
                        &nbsp;se asignó al paciente &nbsp;<strong><?= $result['paciente']?></strong> &nbsp;(Fec. Toma <?= $result['fecha'] ?>).
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
            }
        ?>
    </main>
    <?php
        $customScript = "asignar-prueba.js";
        require_once __DIR__ . '/../../common/footer.php'; 
    ?>
</body>

</html>