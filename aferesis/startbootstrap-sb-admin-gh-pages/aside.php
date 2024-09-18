<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



require_once "Acceso.php";
$acceso = new Acceso();
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Inicio</div>
                    <a class="nav-link" href="inicio.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Paginas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                aria-controls="pagesCollapseAuth">
                                Donantes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="altaDonante.php">Altas</a>
                                    <a class="nav-link" href="editarDonante.php">Modificar Datos</a>
                                    <a class="nav-link" href="listarDonantes.php">Listar Donantes</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseError" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="listarUsuarios.php">Listar Usuarios</a>
                                    <a class="nav-link" href="modificarPermisos.php">Modificar Permisos</a>
                                    <a class="nav-link" href="creaUsuarios.php">Crear Usuarios</a>
                                    <a class="nav-link" href="./confirmarSolicitudes.php">Confirmar Solicitudes</a>
                                </nav>
                            </div>
                        </nav>
                    </div>


                    <div class="sb-sidenav-menu-heading">Complementos</div>
                    <a class="nav-link" href="altaFestivos.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-plus"></i></div>
                        Gestión de Festivos
                    </a>
                    <a class="nav-link" href="calendario.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        Calendario Vista Donante
                    </a>
                    <a class="nav-link" href="calendarioUser.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-calendar"></i></div>
                        Calendario Vista Personal
                    </a>
                    <a class="nav-link" href="horarios_disponibles.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                        Gestionar Citas
                    </a>
                    <a class="nav-link" href="opcionesMaquinas.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Máquinas
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Bienvenido
                    <?php echo $_SESSION['nombre'] ?>
                </div>
            </div>
        </nav>
    </div>