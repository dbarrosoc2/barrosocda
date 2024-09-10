<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<?php 
if (isset($customScript)) { echo "<script src='$url_base/js/$customScript'></script>";}?>
<script src="<?= $url_base ?>js/main.js"></script>
<?php if (isset($panelAdmin)) { ?>
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; 2024 <strong><span>UPRIC</span></strong> | David Barroso
        </div>
    </footer>
<?php } else if (!str_contains($_SERVER['REQUEST_URI'], "login")){ ?>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top container">
        <p class="col-12 col-md-5 mb-0 text-body-secondary text-center text-md-start">&copy; 2024 UPRIC | David Barroso</p>

        <div class="col-12 col-md-7">
            <ul class="nav  justify-content-center justify-content-md-end">
                <li class="nav-item"><a href="<?= $url_base ?>#nosotros" class="nav-link px-2 text-body-secondary">Sobre nosotros</a></li>
                <li class="nav-item"><a href="<?= $url_base ?>#servicios" class="nav-link px-2 text-body-secondary">Servicios</a></li>
                <li class="nav-item"><a href="<?= $url_base ?>pages/contacto.php" class="nav-link px-2 text-body-secondary">Contacto</a></li>
            </ul>
        </div>
    </footer>
<?php } ?>