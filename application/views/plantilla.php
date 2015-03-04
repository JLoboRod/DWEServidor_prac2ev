<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>2DAW Tienda Online</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/estilos.css'); ?>">
    </head>
    <body>
        <div class="container col-md-12 col-xs-12 col-sm-12"
        <?= $html_encabezado ?>
        <div class="container">
            <?= $html_cuerpo ?>
        <?= $html_pie ?>
        </div>
    </body>
    <script src="<?= base_url('/assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
</html>
