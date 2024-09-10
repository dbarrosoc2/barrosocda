<?php require("url-base.php"); ?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= "UPRIC | $title"; ?></title>
    <meta content="Aplicación web de gestión para pacientes y pruebas en centro de salur." name="description">
    <meta content="" name="keywords">

    <link rel=" alternate icon" class="js-site-favicon" type="image/png" href="<?= $url_base ?>favicon.png">
    <link rel="icon" class="js-site-favicon" type="image/png" href="<?= $url_base ?>favicon.png">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="<?= $url_base ?>styles/main.css" rel="stylesheet">

    <?php
        if (isset($customStyle)) {
            echo "<link rel='stylesheet' href='$url_base/styles/$customStyle' type='text/css'/>";
        }?>
</head>