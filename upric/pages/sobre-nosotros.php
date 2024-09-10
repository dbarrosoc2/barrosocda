<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<?php
$title = '| Sobre nosotros';
?>
<?php include '../common/head.php'; ?>

<body>
    <?php include '../common/header.php'; ?>
    <?php include '../common/sidebar.php'; ?>

    <main class="container">
        <div class="row">
            <div class="col-md-4">
                <div style="padding-top: 1.5rem;"></div>
                <!-- Form Login -->
                <?php include '../common/form-login.php'; ?>

                <!-- Unidad Regional de Inmunología Clínica -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">¿Qué es la Unidad Regional de Inmunología Clínica del Estado Aragua?</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            Es una Unidad Programática dependiente de la Dirección Regional de Epidemiologia y Atención Integral en Salud de la Corporación de Salud del Estado Aragua. Fue Fundada en el año 1976, gracias a la iniciativa del Dr. Nicolás Bianco, Director para ese entonces del Instituto de Inmunología de la UCV, como parte de una red nacional de unidades de Inmunología que aún existen. La finalidad inicial era contar con una Institución de alta calificación en el Estado Aragua para la realización de análisis inmunológicos. En su primera etapa funcionó como Laboratorio de Inmunología exclusivamente, pero con la Incorporación de la Dra Rosalba Ovalles, Pediatra e inmunóloga Clínica, se inicia la Consulta de Inmunología Clínica, con la finalidad de consolidar la atención integral (clínica y bioanalítica) al paciente con patología inmunológicas en el Estado Aragua.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">

                <!-- Misión -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">¡Nuestra Misión!</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            Garantizar la atención integral en el área de la Inmunología Clínica a toda la población del Estado Aragua. Servir como apoyo especializado a la Red de Atención Integral en Salud de Aragua y a todas las demás especialidades médicas en casos médicos complejos que ameriten nuestra participación experta.
                        </p>
                    </div>
                </div>

                <!-- Visión -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">¡Nuestra Visión!</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            La Salud, es un derecho social complejo, que requiere del concurso colectivo de voluntades que se sumen con el objetivo de garantizarle al Individuo el menor impacto de las patologías en su bienestar cotidiano. La Inmunología Clínica forma parte de este colectivo de voluntades que buscan minimizar el impacto deletéreo de las patologías en el individuo. Con su apoyo e intervención se realiza prevención primaria en algunos casos y prevención secundaria en la mayoría de los casos que ameritan experticia inmunológica.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="https://www.corposaludaragua.gob.ve/index.php/login">CorpoSaludAragua</a> |
                        <a href="http://mpps.gob.ve/">MPPPS</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">

                <!-- Webs de Interés -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">Webs de interés</h2>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="https://www.instagram.com/acivaaragua/">Instagram ACIVA</a></li>
                            <li><a href="https://www.corposaludaragua.gob.ve/index.php/login">CorpoSaludAragua</a></li>
                            <li><a href="https://twitter.com/HospitalMaracay">HCM</a></li>
                            <li><a href="https://m.facebook.com/profile.php?id=152836751421677">HOSPITAL CIVIL MARACAY</a></li>
                        </ul>
                        <img class="center img-fluid mt-3" src="../public/images/1.png" alt="UPRIC Logo" />
                    </div>
                </div>

                <!-- Políticas de Salud -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">Políticas de Salud</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            Fortalecer con nuestra participación especializada, el papel rector y conductor de Corposalud como eje del Sistema de Salud de Aragua. Prestar apoyo especializado en el área de la Inmunología Clínica (Clínica y Bioanalítica) a la Red de Atención Integral en Salud del Estado Aragua y estados circunvecinos
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../common/footer.php'; ?>
</body>

</html>