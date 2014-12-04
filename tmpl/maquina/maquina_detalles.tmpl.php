<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/maquina/maquina_detalles.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/maquina/maquina_detalles.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Máquina: <?php echo $maquina->get_nombre(); ?>
                    </h2>
                    <div class='contenidoSeccion'>
                        <table id="tablaDatosMaquina">
                            <tr>
                                <td>
                                    ID:
                                </td>
                                <td>
                                    <?php echo $maquina->get_id(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nombre:
                                </td>
                                <td>
                                    <?php echo $maquina->get_nombre(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sistema Operativo:
                                </td>
                                <td>
                                    <?php echo $maquina->get_sistema_operativo()->get_nombre(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fecha alta:
                                </td>
                                <td>
                                    <?php echo $maquina->get_fecha_alta(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fecha sincornización:
                                </td>
                                <td>
                                    <?php echo $maquina->get_fecha_sincronizacion(); ?>
                                </td>
                            </tr>
                        </table>
                        </br>
                        <?php if (isset($template_componentes) && !empty($template_componentes)): ?>
                            <h3 class="titulo subtituloSeccion">Componentes</h3>
                            <table id="tablaContenedorComponentes">
                                <?php $contador = 0; $cantidad_celdas_x_fila = 4; ?>
                                <?php foreach ($template_componentes as $nombre_tempate_componente => $template_componente): ?>
                                        <?php foreach ($template_componente as $objecto): ?>
                                            <?php if (($contador % $cantidad_celdas_x_fila) === 0): ?>
                                            <tr>
                                            <?php endif; ?>
                                                <td style="width:<?php echo (int)(100/$cantidad_celdas_x_fila); ?>%;">
                                                    <div class="componente">
                                                        <h4 class="tituloComponente"><?php echo $nombre_tempate_componente; ?></h4>
                                                        <table class="tableDatoComponente">
                                                            <?php foreach ($objecto as $nombre_propiedad => $valor_propiedad): ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $nombre_propiedad; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $valor_propiedad; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </table>
                                                    </div>
                                                </td>
                                            <?php $contador++; ?>
                                            <?php if (($contador % $cantidad_celdas_x_fila) === 0): ?>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>