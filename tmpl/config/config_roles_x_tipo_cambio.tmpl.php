<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/lib/font-awesome-4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $global_ruta_web; ?>/css/config/config_roles_x_tipo_cambio.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/sincronizar.js" type="text/javascript"></script>
        <script src="<?php echo $global_ruta_web; ?>/js/config/config_roles_x_tipo_cambio.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Configurar roles por tipo de cambio
                    </h2>
                    <div class='contenidoSeccion'>
                        <table class="general" id='tablaConfig'>
                            <thead>
                                <tr>
                                    <td rowspan="2">
                                        Tipo de cambio
                                    </td>
                                    <td colspan="<?php echo count($roles); ?>">
                                        Roles de usuario
                                    </td>
                                </tr>
                                <tr>
                                    <?php foreach ($roles as $rol): ?>
                                        <td class="columnaRol">
                                            <i class="fa fa-caret-square-o-down icono iconoBoton"></i>
                                            <?php echo Util::capitalizar_texto($rol->get_nombre()); ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tipos_cambio as $tipo_cambio): ?>
                                    <tr class="filaTipoCambio">
                                        <td>
                                            <?php echo Util::capitalizar_texto($tipo_cambio->get_nombre()); ?>
                                            <i class="fa fa-caret-square-o-right icono iconoBoton"></i>
                                        </td>
                                        <?php foreach ($roles as $rol): ?>
                                            <td class="celdaCheckbox">
                                                <input type="checkbox" name="chkTipoCambio"/>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>