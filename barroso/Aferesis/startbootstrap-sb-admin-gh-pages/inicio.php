<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['valid'])){
	 require 'conexion.php';

            // Consulta para verificar si el usuario existe
            $consulta = $pdo->prepare("SELECT dni, cod_empleado, nombre, apellidos, email, password, id_rol 
                                       FROM personal 
                                       WHERE dni = :dni");
            $consulta->bindParam(':dni', $_SESSION['usuario']);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {             
                    $_SESSION['valid'] = true;
                    $_SESSION['usuario'] = $resultado['dni'];
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['nombre'] = $resultado['nombre'];
                    $_SESSION['apellidos'] = $resultado['apellidos'];
                    $_SESSION['email'] = $resultado['email'];
                    $_SESSION['idempleado'] = $resultado['cod_empleado'];
                    $_SESSION['rol'] = $resultado['id_rol'];
               }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Inicio";
require_once "./head.php";
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Aferesis</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Panel de opciones</li>
                </ol>
        </main>
        <?php
        require_once "./footer.php";
        ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>