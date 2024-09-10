<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?><!DOCTYPE html>
<html lang="en">
<?php
$title = "Alta Donante";
require_once "./head.php";
require "./Usuarios.php";
require "./funciones.php";
require_once "conexion.php";

// Array para almacenar los mensajes de error
$errores = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario existen antes de acceder a ellos
    $nombre = isset($_POST["nombre"]) ? limpiar($_POST["nombre"]) : "";
    $apellido1 = isset($_POST["apellido1"]) ? limpiar($_POST["apellido1"]) : "";
    $apellido2 = isset($_POST["apellido2"]) ? limpiar($_POST["apellido2"]) : NULL;
    $nhc = isset($_POST["nhc"]) ? limpiar($_POST["nhc"]) : null;
    $cipa = isset($_POST["cipa"]) ? limpiar($_POST["cipa"]) : null;
    $telefono = isset($_POST["telefono"]) ? limpiar($_POST["telefono"]) : "";
    $numDonante = isset($_POST["numDonante"]) ? strtoupper(limpiar($_POST["numDonante"])) : NULL;
    $fechaNa = isset($_POST["fechaNa"]) ? limpiar($_POST["fechaNa"]) : null;

    // Si no se proporciona ninguna fecha, se usa "1900-01-01" como valor predeterminado
    if (empty($fechaNa)) {
        $fechaNa = "1900-01-01";
    }


    // Verificar si se marcó el checkbox de aceptaComunicaciones
    $aceptaComunicaciones = isset($_POST["aceptaComunicaciones"]) ? "Sí" : "No";

    // Verificar si algún campo está vacío
    if (empty($nombre)) {
        $errores['nombre'] = "Debes ingresar el nombre.";
    }
    if (empty($apellido1)) {
        $errores['apellido1'] = "Debes ingresar el primer apellido.";
    }
    if (empty($numDonante)) {
        $errores['numDon'] = "Debes ingresar el numero de donante.";
    }

    if (empty($telefono)) {
        $errores['telefono'] = "Debes ingresar el teléfono.";
    } elseif (!preg_match("/^[0-9]{9}$/", $telefono)) {
        $errores['telefono'] = "El teléfono debe contener 9 dígitos numéricos.";
    }
    if (empty($nhc)) {
        $nhc = null;
    }
    if (empty($cipa)) {
        $cipa = null;
    }


    // Si no hay errores, puedes continuar con el procesamiento de los datos
    if (empty($errores)) {
        try {
            $queryValidar = "SELECT id_donante FROM donante WHERE dni= :numDonante";
            $stmt = $pdo->prepare($queryValidar);
            $stmt->bindParam(':numDonante', $numDonante, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $errorDuplicado = "<div class='alert alert-danger' role='alert'>Este usuario ya existe en la Base de datos.</div>";
            } else {
                require_once "Donantes.php";
                $donante = new Donantes();
                $resultado = $donante->AltaDonante($nombre, $apellido1, $apellido2, $nhc, $telefono, $numDonante, $cipa, $fechaNa, $aceptaComunicaciones);
                if ($resultado) {
                    $opeExitosa = "<div class='alert alert-success' role='alert'>El paciente ha sido dado de alta correctamente:<br>
                    <strong>Nombre:</strong> $nombre $apellido1 $apellido2<br>
                    <strong>NHC:</strong> $nhc<br>
                    <strong>CIPA:</strong> $cipa<br>
                    <strong>Teléfono:</strong> $telefono<br>
                    <strong>Numero Donante:</strong> $numDonante<br>
                    <strong>Fecha de Nacimiento:</strong> $fechaNa<br>
                    <strong>Acepta Comunicaciones:</strong> $aceptaComunicaciones
                </div>";
                } else {
                    $opeExitosa = "<div class='alert alert-danger' role='alert'>El paciente no ha sido dado de alta<br>"
                    ;
                }



            }
        } catch (PDOException $e) {
            // Manejar el error de la consulta SQL
            $errorVerfic = "Error: " . $e->getMessage();
        }
    }

}
?>

<body class="sb-nav-fixed">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <?php
             
  
              if (isset($errores)) {
                require_once "./nav.php";
                require_once "./aside.php";            
                    ?>

                    <div class="container" style="margin-top: 4rem; margin-bottom: 2rem;">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="text-center">Alta de Donante</h2>
                                        <!-- Mostrar errores -->
                                        <?php if (!empty($errores)): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <ul>
                                                    <?php foreach ($errores as $error): ?>
                                                        <li>
                                                            <?php echo $error; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif;
                                        if (!empty($errorDuplicado)) {
                                            echo $errorDuplicado;
                                            $errorDuplicado = "";
                                        } ?>
                                        <?php
                                        if (!empty($opeExitosa)) {
                                            echo $opeExitosa;
                                        }
                                        ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido1" class="form-label">Apellido 1</label>
                                                <input type="text" class="form-control" id="apellido1" name="apellido1"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido2" class="form-label">Apellido 2</label>
                                                <input type="text" class="form-control" id="apellido2" name="apellido2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nhc" class="form-label">NHC</label>
                                                <input type="text" class="form-control" id="nhc" name="nhc">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cipa" class="form-label">CIPA</label>
                                                <input type="text" class="form-control" id="cipa" name="cipa">
                                            </div>
                                            <div class="mb-3">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numDonante" class="form-label">Numero Donante:</label>
                                                <input type="text" class="form-control" id="numDonante" name="numDonante"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fechaNa" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fechaNa" name="fechaNa">
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="aceptaComunicaciones"
                                                    name="aceptaComunicaciones">
                                                <label class="form-check-label" for="aceptaComunicaciones">Acepta
                                                    comunicaciones</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                } else {
                    // Si no hay sesión de usuario, mostrar mensaje de error
                    echo "No se ha iniciado sesión.";
                }
                ?>


            </div>
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