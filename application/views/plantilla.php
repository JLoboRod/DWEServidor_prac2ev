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
    <div class="container">
        <?= $encabezado ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <?= $cuerpo ?>
            </div>
        </div>
        <?= $pie ?>
    </div>
        <!-- Código opcional para limpiar las columnas XS en caso de que el
        contenido de todas las columnas no coincida en altura -->
        <div class="clearfix visible-xs"></div>
    </body>
    <script src="<?= base_url('/assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
    </html>
