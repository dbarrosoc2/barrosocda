<?php if (isset($panelAdmin)) { ?>
  <header id="header" class="header fixed-top d-flex align-items-center  header-admin">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn d-lg-none"></i>
      <a class="navbar-brand logo d-flex align-items-center" href="<?= $url_base ?>admin/panel.php">
        <img src="<?= $url_base ?>public/images/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top me-1">
        <span>UPRIC</span>
      </a>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= $url_base ?>public/images/alta-prueba.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nombre']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6 class="text-start"><?= "{$_SESSION['nombre']} {$_SESSION['apellido']}"; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= $url_base ?>admin/usuarios/cuenta.php">
                <i class="bi bi-person"></i>
                <span>Mi perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= $url_base ?>admin/logs.php">
                <i class="bi bi-person"></i>
                <span>Logs</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= $url_base ?>/controllers/cerrar-sesion.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesión</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </header>
<?php
} else {
?>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">
      <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn d-lg-none"></i>
        <a class="navbar-brand logo d-flex align-items-center" href="<?= $url_base ?>">
          <img src="<?= $url_base ?>public/images/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top me-1">
          <span>UPRIC</span>
        </a>
      </div>
      <nav class="header-nav">
          <ul class="d-flex align-items-center">
            <li class="nav-item d-none d-lg-inline-flex">
              <a class="nav-link" href="<?= $url_base ?>#nosotros">Sobre Nosotros</a>
            </li>
            <li class="nav-item d-none d-lg-inline-flex">
              <a class="nav-link" href="<?= $url_base ?>#servicios">Servicios</a>
            </li>
            <li class="nav-item d-none d-lg-inline-flex">
              <a class="nav-link" href="<?= $url_base ?>pages/contacto.php">Contacto</a>
            </li>
            <?php if (!preg_match('(login)', $_SERVER['REQUEST_URI']) && !isset($_SESSION['valid'])) { ?>
              <li class="nav-item">
                <a 
                class="btn <?php echo str_contains($_SERVER['REQUEST_URI'], "contacto") || str_contains($_SERVER['REQUEST_URI'], "sobre-nosotros") || str_contains($_SERVER['REQUEST_URI'], "servicios") ? "btn-primary": "btn-outline-primary" ?>" 
                href="<?= $url_base ?>pages/login.php">
                  Iniciar sesión
                </a>
              </li>
            <?php } ?>
            <?php if(isset($_SESSION['nombre'])) { ?>
              <li class="nav-item">
                <a class="btn btn-primary d-flex align-items-center " href="<?= $url_base ?>admin/panel.php">
                  <i class="bi bi-people-fill me-3  d-none d-sm-flex"></i>Área de usuarios
                </a>
              </li>
            <?php } ?>
          </ul>
         
      </nav>
    </div>
  </header>
<?php
}
?>