<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/lib/font-awesome-4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
    </head>
    <body>
        <?php require_once dirname(__FILE__) . '/marco/cabecera.tmpl.php' ?>
        <main>
            <aside id="menuPrincipal">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-desktop fa-fw icono"></i>Máquinas</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cog fa-fw icono"></i>Configurar</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-refresh fa-fw icono"></i>Sincronizar</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw icono"></i>Componentes</a>
                    </li>
                </ul>
            </aside>
            <div id="contenido">

            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>