<header>
    <!-- Barra de Navegación (fija) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="../public/logo.jpg" alt="Logo" width="200" height="50"
                    class="d-inline-block align-text-top me-1">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link custom-link-color text-dark" href="../pages/inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link-color text-dark" href="../pages/infoUser.php">
                            <?php echo $_SESSION['nombre'] . "  " . $_SESSION['apellidos']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link custom-link-color text-dark" onclick="goBack()">Volver</button>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link custom-link-color text-dark" href="./cerrarSession.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
            <!-- Aquí agregamos el elemento que muestra la última hora de conexión -->
            <?php if (isset($_SESSION['timeout'])): ?>
                <div class="container-ultima-conexion ml-3 mt-2 text-center">
                    <small class="text-muted small-text">
                        Última hora de conexión para el usuario
                        <?php echo $_SESSION['timeout']; ?>
                    </small>
                </div>
            <?php endif; ?>

        </div>
    </nav>
    <!-- Espaciado para evitar que el contenido se superponga con la barra de navegación fija -->
    <div style="padding-top: 5rem;"></div>
    <?php if (!isset($_SESSION['valid'])) {
        header("Location: login.php");
        exit();
    } ?>
</header>
<style>
    /* Estilos adicionales para los enlaces y botones */
    .nav-link.btn,
    .nav-link.btn:hover {
        text-decoration: none;
        /* Quitar subrayado */
        color: #000;
        /* Color de texto */
        background-color: transparent;
        /* Fondo transparente */
        border: 1px solid transparent;
        /* Borde transparente */
        border-radius: 0.25rem;
        /* Bordes redondeados */
        padding: 0.375rem 0.75rem;
        /* Espaciado interno */
        transition: all 0.3s ease-in-out;
        /* Transición suave */
    }

    /* Estilos adicionales para cuando el botón está activo */
    .nav-link.btn:active {
        background-color: #e9ecef;
        /* Cambiar color de fondo */
    }

    /* Cambiar color de fondo al pasar el cursor */
    .nav-link.btn:hover {
        background-color: #f8f9fa;
        /* Cambiar color de fondo al pasar sobre el botón */
    }
</style>