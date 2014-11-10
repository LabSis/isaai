<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/lib/font-awesome-4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/sincronizar.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/marco/menu_principal.tmpl.php' ?>
            <div id="contenido">

            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>