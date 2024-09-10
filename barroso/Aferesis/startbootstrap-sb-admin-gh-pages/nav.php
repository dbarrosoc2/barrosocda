<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="inicio.php">Aféresis

    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form method="POST" action="busquedaDonantes.php"
        class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Busqueda de donantes..." name="busqueda"
                id="inputBusqueda" aria-label="Buscar por..." aria-describedby="btnNavbarSearch" />
            <input class="btn btn-primary bi bi-search" type="submit" id="btnNavbarSearch" type="button" value="Bucar">
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="miCuenta.php">Mi Cuenta</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="./logout.php">Cerrar Session</a></li>
            </ul>
        </li>
    </ul>
</nav>