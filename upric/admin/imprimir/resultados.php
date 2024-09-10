<?php
    include '../../common/session-checker.php';
    require_once "../../controllers/POO/CLASS/funciones.php";
    require_once "../../controllers/POO/CLASS/Paciente.php";
    // Crear instancia de la clase que contiene la función listarPacientesParaSelect
    $database = new Paciente(); 
    $title = "Generar Resultados";
    $description = "Crea reportes en formato PDF.";
    $panelAdmin = true;
?>

<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php';?>
<body>
    <?php include '../../common/header.php'; ?>
    <?php include '../../common/sidebar.php'; ?>
    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>
        <div class="card">
            <div class="card-body">
                <form  method="GET" action="../../controllers/POO/genera-pdf.php" target="_blank" class="row g-4">
                    <div class="col-md-12">
                        <div class="form-floating ">
                            <select class="form-select" id="idPaciente" name="idPaciente" aria-label="paciente" required>
                                <?php 
                                    echo $database->listarPacientesParaSelectImpre(); 
                                ?>
                            </select>
                            <label for="prueba_id">Selecciona un paciente</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btnFormSubmit" name="submit">Generar PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>
</html>