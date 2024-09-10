<?php
include '../common/session-checker.php';

$title = 'Panel de administrador';
$description = 'Resumen estadístico de UPRIC';
$panelAdmin = true
?>

<!DOCTYPE html>
<html lang="es">

<?php include '../common/head.php'; ?>

<body>

  <?php include '../common/header.php';    ?>

  <?php include '../common/sidebar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <?php include '../common/page-title.php'; ?>

      <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">

                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="./pacientes/alta.php">Alta</a></li>
                      <li><a class="dropdown-item" href="./pacientes/consultar.php">Consultar</a></li>
                      <li><a class="dropdown-item" href="./pacientes/asignar-prueba.php">Asignar pruebas</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Pacientes</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-person"></i>
                      </div>
                      <div class="ps-3">
                        <?php
                        require_once "../controllers/database-connection.php";
                        ?>
                        <h6><?php
                            try {
                              $query = "SELECT COUNT(*) as total FROM paciente";
                              $stmt = $conn->prepare($query);
                              $stmt->execute();
                              $result = $stmt->fetch(PDO::FETCH_ASSOC);
                              echo $result['total'];
                            } catch (PDOException $e) {
                              // Manejo de excepciones
                              echo "Error: " . $e->getMessage();
                              return 0;
                            }
                            ?></h6>
                        <span class="text-muted small pt-2 ps-1">Registrados</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">

                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="./pruebas/alta.php">Alta</a></li>
                      <li><a class="dropdown-item" href="./pruebas/consultar.php">Consultar</a></li>
                      <li><a class="dropdown-item" href="./pruebas/reportar.php">Reportar</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Pruebas</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-medical"></i>
                      </div>
                      <div class="ps-3">
                        <h6><?php
                            try {
                              $query = "SELECT COUNT(*) as total FROM prueba_paciente where resultado is null ";
                              $stmt = $conn->prepare($query);
                              $stmt->execute();
                              $result = $stmt->fetch(PDO::FETCH_ASSOC);
                              echo $result['total'];
                            } catch (PDOException $e) {
                              // Manejo de excepciones
                              echo "Error: " . $e->getMessage();
                              return 0;
                            }
                            ?></h6>
                        <span class="text-muted small pt-2 ps-1">Pendientes</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="./imprimir/resultados.php">Imprimir</a></li>
                      <!-- <li><a class="dropdown-item" href="#">Enviar por correo</a></li>
                      <li><a class="dropdown-item" href="#">Historico Pacientes</a></li> -->
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Resultados</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-printer"></i>
                      </div>
                      <div class="ps-3">
                        <h6><?php
                            try {
                              $query = "SELECT COUNT(*) as total FROM prueba_paciente where resultado is not null ";
                              $stmt = $conn->prepare($query);
                              $stmt->execute();
                              $result = $stmt->fetch(PDO::FETCH_ASSOC);
                              echo $result['total'];
                            } catch (PDOException $e) {
                              // Manejo de excepciones
                              echo "Error: " . $e->getMessage();
                              return 0;
                            }
                            ?>
                        </h6>
                        <span class="text-muted small pt-2 ps-1">Reportados</span>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="./usuarios/alta.php">Añadir Usuarios</a></li>
                      <li><a class="dropdown-item" href="./usuarios/consultar.php">Editar/Eliminar Usuarios</a></li>
                      <li><a class="dropdown-item" href="./usuarios/cuenta.php">Mi cuenta</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <h6><?php
                            try {
                              $query = "SELECT COUNT(*) as total FROM usuario";
                              $stmt = $conn->prepare($query);
                              $stmt->execute();
                              $result = $stmt->fetch(PDO::FETCH_ASSOC);
                              echo $result['total'];
                            } catch (PDOException $e) {
                              // Manejo de excepciones
                              echo "Error: " . $e->getMessage();
                              return 0;
                            }
                            ?></h6>
                        <span class="text-muted small pt-2 ps-1">Registrados</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </main>
  <div style="padding-top: 18rem;"></div>
  <?php include '../common/footer.php'; ?>
</body>

</html>