<aside id="sidebar" class="sidebar <?php echo str_contains($_SERVER['REQUEST_URI'], "admin") ? "" : "sidebar-home" ?>">
    <?php if (isset($panelAdmin)) { ?>
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "panel") ? "" : "collapsed" ?>" href="<?= $url_base ?>/admin/panel.php">
                    <i class="bi bi-grid"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "pacientes") ? "" : "collapsed" ?>" data-bs-target="#pacientes-nav" data-bs-toggle="collapse" href="#" aria-expanded="true">
                    <i class="bi bi-file-person"></i>
                    <span>Pacientes

                    </span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pacientes-nav" class="nav-content <?php echo str_contains($_SERVER['REQUEST_URI'], "pacientes") ? "" : "collapse" ?> " data-bs-parºent="#sidebar-nav
                ">

                    <li>
                        <a href="<?= $url_base ?>/admin/pacientes/alta.php" class="<?php echo preg_match('(pacientes)', $_SERVER['REQUEST_URI']) && preg_match('(alta)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Alta</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/pacientes/consultar.php" class="<?php echo preg_match('(pacientes)', $_SERVER['REQUEST_URI']) && (preg_match('(consultar)', $_SERVER['REQUEST_URI']) || preg_match('(modificar)', $_SERVER['REQUEST_URI'])) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Consultar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/pacientes/asignar-prueba.php" class="<?php echo preg_match('(pacientes)', $_SERVER['REQUEST_URI']) && preg_match('(asignar)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Asignar prueba</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/pacientes/listado.php" class="<?php echo preg_match('(pacientes)', $_SERVER['REQUEST_URI']) && preg_match('(listado)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Listado de pacientes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "pruebas") ? "" : "collapsed" ?>" data-bs-target="#pruebas-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-medical"></i><span>Pruebas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pruebas-nav" class="nav-content <?php echo str_contains($_SERVER['REQUEST_URI'], "pruebas") ? "" : "collapse" ?> " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $url_base ?>/admin/pruebas/alta.php" class="<?php echo preg_match('(pruebas)', $_SERVER['REQUEST_URI']) && preg_match('(alta)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Alta</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/pruebas/consultar.php" class="<?php echo preg_match('(pruebas)', $_SERVER['REQUEST_URI']) && preg_match('(consultar)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Consultar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/pruebas/reportar.php" class="<?php echo preg_match('(pruebas)', $_SERVER['REQUEST_URI']) && preg_match('(reportar)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Reportar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "usuarios") ? "" : "collapsed" ?>" data-bs-target="#usuarios-nav" data-bs-toggle="collapse" href="#" aria-expanded="true">
                    <i class="bi bi-file-person"></i>
                    <span>Usuarios</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="usuarios-nav" class="nav-content <?php echo str_contains($_SERVER['REQUEST_URI'], "usuarios") ? "" : "collapse" ?> " data-bs-parent="#sidebar-nav
                    ">

                    <li>
                        <a href="<?= $url_base ?>/admin/usuarios/alta.php" class="<?php echo preg_match('(usuarios)', $_SERVER['REQUEST_URI']) && preg_match('(alta)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Alta</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $url_base ?>/admin/usuarios/consultar.php" class="<?php echo preg_match('(usuarios)', $_SERVER['REQUEST_URI']) && preg_match('(consultar)', $_SERVER['REQUEST_URI']) ? "active" : "" ?>">
                            <i class="bi bi-circle"></i><span>Consultar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "/imprimir/resultados") ? "" : "collapsed" ?>" href="<?= $url_base ?>/admin/imprimir/resultados.php">
                    <i class="bi bi-printer"></i>
                    <span>Imprimir resultados</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $url_base ?>">
                    <i class="bi bi-house-door"></i>
                    <span>Volver a Home</span>
                </a>
            </li>
            <li class="nav-heading">Usuario</li>
            <li class="nav-item">
                <a class="nav-link <?php echo str_contains($_SERVER['REQUEST_URI'], "usuarios") ? "" : "collapsed" ?>" href="<?= $url_base ?>/admin/usuarios/cuenta.php">
                    <i class="bi bi-person"></i><span>Perfil</span>
                </a>
            </li>
        </ul>
    <?php } else { ?>
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $url_base ?>#servicios">
                    <i class="bi bi-star"></i>
                    <span>Servicios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $url_base ?>pages/contacto.php">
                    <i class="bi bi-telephone"></i>
                    <span>Contacto</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $url_base ?>#nosotros">
                    <i class="bi bi-hospital"></i>
                    <span>Sobre nosotros</span>
                </a>
            </li>
        </ul>

    <?php } ?>
</aside>
<div class="sidebar-background"></div>