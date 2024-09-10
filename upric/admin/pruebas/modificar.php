<?php
  include '../../common/session-checker.php';
  require_once '../../controllers/POO/CLASS//Prueba.php';
  require_once "../../controllers/POO/CLASS/funciones.php";

  $title = "Actualizar prueba";
  $description = "Modifica los datos registrados de la prueba.";
  $panelAdmin = true;
  require_once "../../controllers/POO/CLASS/Permisos.php";
  $permisos = new Permisos();
  $numPermiso = $_SESSION['permiso'];
  $database = new Prueba();
  if (isset($_GET['id_prueba']) && !empty($_GET['id_prueba'])) {
      $idPrueba = limpiar($_GET['id_prueba']);
      $datosPrueba = $database->obtenerPruebaPorId($idPrueba);
  }
?>
<!DOCTYPE html>
<html lang="es">
  <?php include '../../common/head.php'; ?>

<body>
  <?php include '../../common/header.php';  ?>
  <?php include '../../common/sidebar.php'; ?>

  <main id="main" class="main">
    <?php include '../../common/page-title.php'; ?>

    <div class="card">
      <div class="card-body">
        <?php
                if ($permisos->verificarPermisosBioquimico($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>

        <?php
          if (isset($datosPrueba) && $datosPrueba) {
        ?>
          <form id="formulario" class="row g-4 needs-validation" novalidate action="../../controllers/POO/prueba-editar.php" method="post">
            <input type='hidden' name='id_prueba' value="<?php echo htmlspecialchars($datosPrueba['id_prueba']); ?>">
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" name="nombre_prueba" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['nombre_prueba']); ?>" required placeholder="Nombre Prueba">
                <label for="nombre_prueba">Nombre Prueba</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" name="valor_ref_min" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['valor_ref_min']); ?>" required placeholder="Valor Ref. mínimo">
                <label for="valor_ref_min">Valor Ref. mínimo</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" name="valor_ref_max" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['valor_ref_max']); ?>" required placeholder="Valor Ref. máximo">
                <label for="valor_ref_max">Valor Ref. máximo</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" name="unidades" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['unidades']); ?>" required placeholder="Unidades">
                <label for="valor_ref_max">Unidades</label>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary" name='accion' value="editar">Actualizar Prueba</button>
            </div>
          </form>
        <?php
        } else {
            echo '<div class="alert alert-danger"><i class="bi bi-exclamation-octagon me-3"></i>No se encontró la prueba.</div>';
        }
        ?>
      </div>
    </div>

    <!-- <section class="section dashboard">
      <form action='../../controllers/POO/prueba-editar.php' method='POST'>
        <input type='hidden' name='id_prueba' value="<?php echo htmlspecialchars($datosPrueba['id_prueba']); ?>">
        <div class="form-group">
          <label for="nombre_prueba">Nombre de la Prueba</label>
          <input type='text' class="form-control" name='nombre_prueba' value="<?php echo htmlspecialchars($datosPrueba['nombre_prueba']); ?>">
        </div>
        <div class="form-group">
          <label for="valor_ref_min">Valor Ref. Mínimo</label>
          <input type='text' class="form-control" name='valor_ref_min' value="<?php echo htmlspecialchars($datosPrueba['valor_ref_min']); ?>">
        </div>
        <div class="form-group">
          <label for="valor_ref_max">Valor Ref. Máximo</label>
          <input type='text' class="form-control" name='valor_ref_max' value="<?php echo htmlspecialchars($datosPrueba['valor_ref_max']); ?>">
        </div>
        <div class="form-group">
          <label for="unidades">Unidades</label>
          <input type='text' class="form-control" name='unidades' value="<?php echo htmlspecialchars($datosPrueba['unidades']); ?>">
        </div>
        <button type='submit' name='accion' value="editar" class='btn btn-primary'>Actualizar Prueba</button>
      </form>
    </section> -->
  </main>
  <?php require_once __DIR__ . '/../../common/footer.php'; ?>
</body>

</html>