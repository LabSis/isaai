<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/lib/font-awesome-4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $global_ruta_web; ?>/css/principal.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/sincronizar.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Todas las máquinas
                    </h2>
                    <div class='contenidoSeccion'>
                        <table class="general" id='tablaMaquinas'>
                            <thead>
                                <tr>
                                    <td>
                                        Id máquina
                                    </td>
                                    <td>
                                        Nombre
                                    </td>
                                    <td>
                                        Fecha alta
                                    </td>
                                    <td>
                                        Fecha última sincronización
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($template_maquinas as $maquina): ?>
                                    <tr>
                                        <td>
                                            <?php echo $maquina['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $maquina['nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $maquina['fecha_alta']; ?>
                                        </td>
                                        <td>
                                            <?php echo $maquina['fecha_sincronizacion']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>