<?php
  include '../../common/session-checker.php';
  require_once '../../controllers/POO/CLASS//Prueba.php';
  require_once "../../controllers/POO/CLASS/funciones.php";
  require_once "../../controllers/POO/CLASS/Permisos.php";
  $permisos = new Permisos();
  $numPermiso = $_SESSION['permiso'];
  $title = "Alta Prueba";
  $description = "Registra nuevas tipo de pruebas";
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
        <form id="formulario" class="row g-4 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" id="nombre_prueba" name="nombre_prueba" class="form-control" value="<?= isset($nombre_prueba) ? $nombre_prueba : '' ?>" required placeholder="Nombre Prueba">
              <label for="nombre_prueba">Nombre Prueba</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating">
              <input type="text" id="valor_ref_min" name="valor_ref_min" class="form-control" value="<?= isset($valor_ref_min) ? $valor_ref_min : '' ?>" required placeholder="Valor Ref. mínimo">
              <label for="valor_ref_min">Valor Ref. mínimo</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating">
              <input type="text" id="valor_ref_max" name="valor_ref_max" class="form-control" value="<?= isset($valor_ref_max) ? $valor_ref_max : '' ?>" required placeholder="Valor Ref. máximo">
              <label for="valor_ref_max">Valor Ref. máximo</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <input type="text" id="unidades" name="unidades" class="form-control" value="<?= isset($unidades) ? $unidades : '' ?>" required placeholder="Unidades">
              <label for="valor_ref_max">Unidades</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-md-end">
            <button type="button" class="btn btn-outline-secondary me-3 btnFormRestart" >Restablecer</button>
            <button type="submit" class="btn btn-primary" name="submit">Registrar nueva prueba</button>
          </div>
        </form>
      </div>
    </div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nombre_prueba = isset($_POST['nombre_prueba']) ? limpiar($_POST["nombre_prueba"]) : "";
        $valor_ref_min = isset($_POST['valor_ref_min']) ? limpiar($_POST["valor_ref_min"]) : "";
        $valor_ref_max = isset($_POST['valor_ref_max']) ? limpiar($_POST["valor_ref_max"]) : "";
        $unidades = isset($_POST['unidades']) ? limpiar($_POST["unidades"]) : "";

        // Validar que todos los campos requeridos estén completos
        if (!isset($_POST["nombre_prueba"]) || empty($_POST["nombre_prueba"])) {
          $errores["nombre_prueba"] = "El campo nombre prueba es obligatorio.";
        }
        if (!isset($_POST["valor_ref_min"]) || empty($_POST["valor_ref_min"])) {
          $errores["valor_ref_min"] = "El campo valor ref min es obligatorio.";
        }
        if (!isset($_POST["valor_ref_max"]) || empty($_POST["valor_ref_max"])) {
          $errores["valor_ref_max"] = "El campo valor ref max es obligatorio.";
        }
        if (!isset($_POST["unidades"]) || empty($_POST["unidades"])) {
          $errores["unidades"] = "El campo Unidades es obligatorio.";
        }

        if (empty($errores)) {
          $database = new Prueba();
          $pruebaCreadaData = $database->crearPrueba($nombre_prueba, $valor_ref_min, $valor_ref_max, $unidades);

          $modalTitle = "¡Nueva prueba creada!";
          $modalDescription = "La prueba <strong>{$pruebaCreadaData['nombre_prueba']}</strong> (Min {$pruebaCreadaData['valor_ref_min']} / Max {$pruebaCreadaData['valor_ref_max']}) fue registrada correctamente.";
          include '../../common/modal-success.php';
        } else {
          implode("</br>", $errores);
        }
      }
    ?>
  </main>
  <?php require_once __DIR__ . '/../../common/footer.php'; ?>
</body>

</html>