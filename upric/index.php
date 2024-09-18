<?php 
    session_start(); 
    $title = 'Inicio';
?>
<!DOCTYPE html>
<html lang="es">

<?php 
$customStyle = "home.css";
include './common/head.php'; 
?>
<script>
        window.onload = function() {
            var user = '12345678A';
            var password = 'prueba';

            // Muestra un mensaje de alerta con los datos
            alert(`Para probar esta web, utiliza los siguientes datos:\nUsuario: ${user}\nContraseña: ${password}`);
        };
    </script>
<body>
    <?php include 'common/header.php';   ?>
    <?php include 'common/sidebar.php'; ?>

    <main class="main-home container">
        <div class="row">
            <div class="col-12">
                <div class="header-index <?php echo isset($_SESSION['valid']) ? "no-form-login": "" ?>">
                    <div class="header-index__texto">
                        <h1>Unidad Regional <br> de Inmunología Clínica <br> del Estado Aragua</h1>
                        <p>Desde 1976 consolidando la atención clínica y bioanalítica al paciente con patología inmunológicas.</p>
                        <?php if (isset($_SESSION['valid'])) { ?>
                            <a class="btn btn-outline-white d-inline-flex align-items-center mt-4" href="<?= $url_base ?>admin/panel.php">
                                <i class="bi bi-people-fill me-3"></i>Entrar al área de usuarios
                            </a>
                        <?php } ?>
                    </div>
                    <?php if (!isset($_SESSION['valid'])) { ?>
                        <div class="header-index__login">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <?php include './common/form-login.php' ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                   
                    <div class="header-index__imagen">
                        <img src="./public/images/hospital-fondo.webp" alt="imagen-fondo">
                    </div>
                </div>
            </div>
        </div>

        <div class="row nosotros-block" id="nosotros">
            <div class="col-12 titular">
                <h2 class="text-center">Sobre nosotros</h2>
                <p class="text-center">Desde su Fundación hasta su Misión Futura en la Atención Integral de la Salud</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0">
                    La Unidad de Inmunología Clínica de Aragua, fundada en 1976, ofrece servicios especializados en análisis e inmunología clínica, proporcionando atención integral a pacientes con patologías inmunológicas en el estado. Su misión es garantizar servicios de calidad y apoyo a la red de atención integral en salud, con una visión de ser un referente en el área de la inmunología clínica para la población de Aragua.
                </p>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row servicios-block d-flex align-items-center justify-content-center" id="servicios">
            <div class="col-12 titular">
                <h2 class="text-center">Servicios</h2>
                <p class="text-center">Técnicas de trabajo y métodos de laboratorio</p>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2 servicios-block__contenido">
                <?php 
                    $itemTitle = "IFI";
                    $itemDescription = "Inmunofluorescencia Indirecta";
                    $itemURL = "http://www.scielo.org.pe/scielo.php?script=sci_arttext&pid=S1726-46341997000100004";
                    include './common/item-block.php';
                ?>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2 servicios-block__contenido">
                <?php 
                    $itemTitle = "ELISA";
                    $itemDescription = "Enzimoinmunoanálisis de adsorción";
                    $itemURL = "https://www.bioted.es/protocolos/INTRODUCCION-ELISA.pdf";
                    include './common/item-block.php';
                ?>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2 servicios-block__contenido">
                <?php 
                    $itemTitle = "IFD";
                    $itemDescription = "Inmunoflorecencia directa";
                    $itemURL = "https://www.parcdesalutmar.cat/es/dermatologia/tecniques-diagnostiques/immunofluorescencia";
                    include './common/item-block.php';
                ?>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2 servicios-block__contenido">
                <?php 
                    $itemTitle = "RID";
                    $itemDescription = "Inmunodifusión <br/> radial";
                    $itemURL = "https://www.bioted.es/protocolos/INMUNODIFUSION-RADIAL.pdf";
                    include './common/item-block.php';
                ?>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2 servicios-block__contenido">
                <?php 
                    $itemTitle = "PCR";
                    $itemDescription = "Reacción en cadena de la polimerasa";
                    $itemURL = "https://www.genome.gov/es/genetics-glossary/Reaccion-en-cadena-de-la-polimerasa";
                    include './common/item-block.php';
                ?>
            </div>
        </div>

        <div class="row enlaces-block">
            <div class="col-12">
                <div class="enlaces-block__contenedor">
                    <div class="enlaces-block__contenedor--item">
                        <a href="https://www.instagram.com/acivaaragua/" target="_blank">
                            <img src="<?= $url_base ?>public/images/interes_logo_1.png" alt="MPPS">
                        </a>
                    </div>
                    <div class="enlaces-block__contenedor--item">
                        <a href="http://mpps.gob.ve/" target="_blank">
                            <img src="<?= $url_base ?>public/images/interes_logo_2.png" alt="ACIVA">
                        </a>
                    </div>
                    <div class="enlaces-block__contenedor--item">
                        <a href="https://www.corposaludaragua.gob.ve/index.php/login" target="_blank">
                            <img src="<?= $url_base ?>public/images/interes_logo_3.png" alt="Corpo Salud Aragua">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row trabajos-block" id="trabajos">
            <div class="col-12 titular">
                <h2 class="text-center">Nuestros Trabajos</h2>
                <p class="text-center">Un Compromiso Constante con la Salud y el Bienestar de la Comunidad</p>
            </div>
            <div class="col-12">
                <div class="trabajos-block__contenedor">
                    <?php 
                        $itemTrabajoTitle =  "Peptido C";
                        $itemTrabajoURL = "https://www.researchgate.net/publication/335680086_Niveles_de_peptido_C_y_glucosa_sanguinea_en_pacientes_con_Virus_de_Inmunodeficiencia_Humana";
                        include './common/item-trabajo.php';
                    ?>
                    <?php 
                        $itemTrabajoTitle =  "Linfocitos T";
                        $itemTrabajoURL = "https://www.researchgate.net/publication/321142495_Contaje_de_linfocitos_T_y_carga_viral_para_virus_de_inmunodeficiencia_humana_tipo_1_en_pacientes_coinfectados_con_virus_linfotropico_de_celulas_T_y_virus_hepatitis_B?_tp=eyJjb250ZXh0Ijp7ImZpcnN0UGFnZSI6InB1YmxpY2F0aW9uIiwicGFnZSI6InByb2ZpbGUiLCJwcmV2aW91c1BhZ2UiOiJwdWJsaWNhdGlvbiJ9fQ";
                        include './common/item-trabajo.php';
                    ?>
                    <?php 
                        $itemTrabajoTitle =  "Screening";
                        $itemTrabajoURL = "https://www.researchgate.net/publication/349721711_Screening_para_virus_de_inmunodeficiencia_humana_por_inmunoensayo_enzimatico_de_cuarta_generacion_en_diferentes_zonas_de_importancia_en_el_estado_Aragua_periodo_2015-2016";
                        include './common/item-trabajo.php';
                    ?>
                    <?php 
                        $itemTrabajoTitle =  "VIH - Seroprevalencia";
                        $itemTrabajoURL = "https://www.researchgate.net/publication/329011751_Situacion_epidemiologica_del_virus_de_inmunodeficiencia_humana_en_el_estado_Aragua_Venezuela_2013-2016?_tp=eyJjb250ZXh0Ijp7ImZpcnN0UGFnZSI6InB1YmxpY2F0aW9uIiwicGFnZSI6InByb2ZpbGUiLCJwcmV2aW91c1BhZ2UiOiJwdWJsaWNhdGlvbiJ9fQ";
                        include './common/item-trabajo.php';
                    ?>
                    <?php 
                        $itemTrabajoTitle =  "Síndrome Metabólico";
                        $itemTrabajoURL = "http://ve.scielo.org/scielo.php?script=sci_arttext&pid=S1690-32932014000200003";
                        include './common/item-trabajo.php';
                    ?>
                </div>
            </div>
        </div>
        

        
    </main>

    <?php include './common/footer.php'; ?>
</body>

</html>