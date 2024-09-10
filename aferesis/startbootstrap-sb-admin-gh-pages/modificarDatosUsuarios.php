<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$title = "Confirmar Usuario ";
require_once "./head.php";
require "./Usuarios.php";
$usuario = new Usuarios();
?>

<body class="sb-nav-fixed">
    <?php
    require_once "./nav.php";
    require_once "./aside.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">
                    <?= $title ?>
                </h1>
                <?php
                $id_usuario = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

                // Crear una instancia de tu clase donde están definidos tus métodos
                $usuario = new Usuarios();

                // Obtener los datos del usuario por su ID
                $datos_usuario = $usuario->ObtenerUsuarioPorId($id_usuario);


                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['confirmar'])) {
                    // Obtener los datos del formulario
                    $id = $_POST['id'];
                    $rol = $_POST['rol'];
                    $usuario->cambiarRolUsuario($id, $rol);
                    $datos_usuario = $usuario->ObtenerUsuarioPorId($id);
                    $mensaje = "El usuario ha sido actualizado y su nuevo rol es: " . $_POST['rol'];
                }

                // Obtener el ID del usuario de la URL
                

                // Comprobar si se han obtenido datos del usuario
                if (isset($datos_usuario) && !empty($datos_usuario)) {
                    // Extraer los datos del usuario
                    $nombre = $datos_usuario['nombre'];
                    $apellido1 = $datos_usuario['apellido1'];
                    $apellido2 = $datos_usuario['apellido2'];
                    @$rol = $datos_usuario['rol'];
                } else {
                    // Si no se obtienen datos del usuario, mostrar un mensaje de error o redirigir a una página de error
                    echo "No se encontraron datos del usuario.";
                }
                ?>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">
                                Seleccione permiso para este usuario
                            </h1>
                            <?php if (isset($mensaje)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $mensaje ?>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" disabled name="nombre"
                                                value="<?php echo $nombre; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="apellido1" class="form-label">Primer Apellido:</label>
                                            <input type="text" class="form-control" id="apellido1" disabled
                                                name="apellido1" value="<?php echo $apellido1; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                                            <input type="text" class="form-control" id="apellido2" disabled
                                                name="apellido2" value="<?php echo $apellido2; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Rol:</label>
                                            <select class="form-select" id="rol" name="rol">
                                                <option disabled selected value="">Selecciona una opción</option>
                                                <option value="Administrador" <?php if ($rol === 'Administrador')
                                                    echo 'selected'; ?>>Administrador</option>
                                                <option value="Super" <?php if ($rol === 'Super')
                                                    echo 'selected'; ?>>
                                                    Super</option>
                                                <option value="Usuario" <?php if ($rol === 'Usuario')
                                                    echo 'selected'; ?>>
                                                    Usuario</option>
                                                <option value="Denegar" <?php if ($rol === 'Denegar')
                                                    echo 'selected'; ?>>
                                                    Denagar</option>
                                            </select>
                                        </div>

                                        <button type="submit" name="confirmar"
                                            class="btn btn-primary">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                    <?php
                    require_once "./footer.php";
                    ?>
                </div>
            </div>
        </main>
        <?php
        require_once "./footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
            crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </div>
</body>

</html>