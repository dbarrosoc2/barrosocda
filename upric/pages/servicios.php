<!DOCTYPE html>
<html lang="es">
<?php
$title = 'Servicios';
?>
<?php include '../common/head.php'; ?>

<body>
    <?php include '../common/header.php'   ?>
    <?php include '../common/sidebar.php'; ?>
    <div style="padding-top: 3rem;"></div>
    <main class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Form Login -->
                <?php include '../common/form-login.php' ?>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Técnicas de trabajo</h2>
                    </div>
                    <div class="work-units">
                        <span class="title-work-unit">IFI</span>
                        <span class="link-work-unit"><a href="https://exa.unne.edu.ar/bioquimica/inmunoclinica/documentos/Laboratorio_TPN8.pdf">Inmunofluorescencia Indirecta</a></span>
                    </div>
                    <div class="work-units">
                        <span class="title-work-unit">ELISA</span>
                        <span class="link-work-unit"><a href="https://www.bioted.es/protocolos/INTRODUCCION-ELISA.pdf">Enzimoinmunoanálisis de adsorción</a></span>
                    </div>
                    <div class="work-units">
                        <span class="title-work-unit">Nefelometría</span>
                        <span class="link-work-unit"><a href="https://medlineplus.gov/spanish/ency/article/003545.htm">Dispersión de luz</a></span>
                    </div>
                    <div class="work-units">
                        <span class="title-work-unit">Inmunodifusión radial</span>
                        <span class="link-work-unit"><a href="https://www.bioted.es/protocolos/INMUNODIFUSION-RADIAL.pdf">Detectar los niveles de proteínas sanguíneas</a></span>
                    </div>
                    <div class="work-units">
                        <span class="title-work-unit">PCR</span>
                        <span class="link-work-unit"><a href="https://www.genome.gov/es/genetics-glossary/Reaccion-en-cadena-de-la-polimerasa">Reacción en cadena de la polimerasa</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">PCR</h2>
                    </div>
                    <div class="card-body">
                        <p><img src="../public/images/pcr.png" class="img-fluid float-left mr-3" alt="UPRIC Logo">
                            <br><br><br><br><br><br><br>
                        <p>Método de laboratorio que sirve para hacer muchas copias de un trozo determinado de ADN a partir de una muestra que tiene cantidades diminutas de este ADN</p>
                    </div>
                    <div class="card-footer">
                        <a href="https://www.corposaludaragua.gob.ve/index.php/login" target="_blank">CorpoSaludAragua</a> |
                        <a href="http://mpps.gob.ve/" target="_blank">MPPPS</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Webs de interés</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="https://www.instagram.com/acivaaragua/" target="_blank">Instagram ACIVA</a></li>
                            <li class="list-group-item"><a href="https://www.corposaludaragua.gob.ve/index.php/login" target="_blank">CorpoSaludAragua</a></li>
                            <li class="list-group-item"><a href="https://twitter.com/HospitalMaracay" target="_blank">HCM</a>
                            </li>
                            <li class="list-group-item"><a href="https://m.facebook.com/profile.php?id=152836751421677" target="_blank">HOSPITAL CIVIL MARACAY</a></li>
                        </ul>
                        <img class="img-fluid mt-3" src="../public/images/1.png" alt="UPRIC Image" />
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include '../common/footer.php'; ?>
</body>

</html>