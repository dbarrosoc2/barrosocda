<?php
    include '../../common/session-checker.php';
    require_once "../../controllers/POO/CLASS/funciones.php";
    require_once '../../controllers/POO/CLASS/Prueba.php';
    require_once '../../controllers/POO/CLASS/Paciente.php';
    require_once '../../controllers/POO/CLASS/Prueba-Paciente.php';
    require_once "../../controllers/POO/CLASS/Permisos.php";
    $permisos = new Permisos();
    $numPermiso = $_SESSION['permiso'];
    $title = "Reportar prueba";
    $description = "Reportar resultados pendientes de pacientes en pruebas especificas.";
    $panelAdmin = true;
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php 
        include '../../common/header.php';
        include '../../common/sidebar.php';
    ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>
        <?php
                if ($permisos->verificarPermisosBioquimico($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="placeholderLoading">
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                        <p class="placeholder-glow"><span class="placeholder col-12"></span></p>
                    </div>
                </div>
                <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-4 d-none">
                    <div class="col-md-12">
                        <div class="form-floating ">
                            <input type="hidden" name="timestamp" value="<?php echo time(); ?>">
                            <select class="form-select" id="prueba_id" name="prueba_id" aria-label="paciente" required>
                                <?php
                                    $database = new Prueba();
                                    $stmt = $database->leerPruebas();
                                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?=$fila['id_prueba']?>" >
                                            <?= $fila['nombre_prueba'] ." - ". $fila['valor_ref_min'] . " a " . $fila['valor_ref_max'] ." - ". $fila['unidades']?>
                                        </option>
                                <?php } ?>
                            </select>
                            <label for="prueba_id">Selecciona una prueba</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btnFormSubmit" name="submit">Buscar prueba</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_SESSION['datos_actualizados'])) {
            foreach ($_SESSION['datos_actualizados'] as $id_paciente => $datos) {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    El resultado del paciente&nbsp; <strong><?=$datos['paciente_nombre']?> (ID <?=$datos['paciente_id']?>)</strong> 
                    &nbsp;se actualizo a &nbsp;<strong><?= $datos['resultado']?></strong>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['datos_actualizados']);
            }
        } elseif (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        ?>

        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_prueba = isset($_POST['prueba_id']) ? limpiar($_POST['prueba_id']) : " ";

                if (empty($id_prueba)) {
                    echo "<div class='alert alert-danger'>Debes seleccionar una prueba de la lista</div>";
                    exit();
                }
                
                echo "<script>let selectedPrueba = $id_prueba</script>";
    
                $database = new Prueba_Paciente();
                $pacientes = $database->listarPacientesParaResultados($id_prueba);
    
                if (count($pacientes) !== 0){
                ?>
                    <div class="card listPruebasReportar">
                        <div class="card-body">
                            <form  method="post" action="../../controllers/POO/guardar-resultados.php" >
                                <div class="row">
                                    <input type='hidden' name='id_prueba' value="<?= $id_prueba ?>">
                                    <div class="col-md-12">
                                        <?=  $database->imprimirPruebaPorId($id_prueba);?>
                                    </div>
                                    <?php foreach ($pacientes as $paciente) { ?>
                                        <div class="col-sm-12 col-md-12 mb-2 ">
                                            <span class="fw-bold">Paciente <?= $paciente['nombre']. " " . $paciente['apellido'] ?></span>  
                                            <span class="fw-light">(ID: <?= $paciente['id_paciente'] ?>)</span>

                                            <input type='hidden' name="<?="paciente_id[{$paciente['id']}]"?>" value="<?= $paciente['id_paciente'] ?>">
                                            <input type='hidden' name="<?="paciente_nombre[{$paciente['id']}]"?>" value="<?= $paciente['nombre'] ?>">
                                            <input type='hidden' name="<?="paciente_apellido[{$paciente['id']}]"?>" value="<?= $paciente['apellido'] ?>">
                                        </div>
                                        <div class="col-sm-12 col-md-3 mb-3 mb-md-0">
                                            <div class="form-floating form-floating-light">
                                                <input 
                                                    type="text" class="form-control form-control-sm" 
                                                    id="<?="resultado_{$paciente['id']}"?>" 
                                                    name="<?="resultado[{$paciente['id']}]"?>" 
                                                    placeholder="Resultado de prueba"
                                                >
                                                <label for="<?="resultado_{$paciente['id']}"?>">Resultado de prueba</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <div class="form-floating form-floating-light">
                                                <input 
                                                    type="text" 
                                                    class="form-control form-control-sm" 
                                                    id="<?="nota{$paciente['id']}"?>" 
                                                    name="<?="nota[{$paciente['id']}]"?>" 
                                                    placeholder="Comentario (Opcional)"
                                                >
                                                <label for="<?="nota{$paciente['id']}"?>">Comentario (Opcional)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-0">
                                            <hr class="divider">
                                        </div>
                                    <?php } ?>
                                    <div class="col-12 d-flex justify-content-md-end">
                                        <button type="button" class="btn btn-outline-secondary me-3 btnFormRestart" >Restablecer</button>
                                        <button type="submit"  name='accion' class="btn btn-primary">Guardar Resultados</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            
                <?php
                }else{
                    echo "<script>let pacientesFlag = true</script>";
                    echo "<div class='alert alert-warning' role='alert'><i class='bi bi-exclamation-triangle'></i> No existen pacientes con esta prueba para reportar</div>";
                }
                ?>
            <?php } ?>
    </main>
    <?php 
        $customScript = "reportar.js";
        require_once __DIR__ . '/../../common/footer.php'; 
    ?>
</body>

</html>