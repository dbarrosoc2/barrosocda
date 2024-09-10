<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top container"
    style="bottom: 0; width: 100%;">
    <p class="col-md-7 mb-0 text-body-secondary">&copy; 2024 | Informatica - Integraciones - David A Barroso C - Alvar J
        Blanco</p>

    <ul class="nav col-md-5 justify-content-end">
        <li class="nav-item"><a href="../pages/loginOk.php" class="nav-link px-2 text-body-secondary"></a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Inicio</a></li>
    </ul>
</footer>
<script>
    // Array para almacenar el historial de páginas visitadas
    var historial = [];

    // Función para ir atrás en la página y actualizar el historial
    function goBack() {
        if (historial.length > 1) {
            var paginaAnterior = historial.pop();
            window.location.href = paginaAnterior;
        } else {
            // Si no hay más páginas en el historial, volver a la página anterior del navegador
            window.history.back();
        }
    }

    // Agregar la página actual al historial cuando se carga
    document.addEventListener("DOMContentLoaded", function () {
        historial.push(window.location.href);
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="../style/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>