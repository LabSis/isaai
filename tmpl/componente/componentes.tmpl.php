<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/componente/componentes.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Todos los componentes
                    </h2>
                    <div class='contenidoSeccion'>
                        <form action="<?php echo $global_ruta_web; ?>/src/ctrl/componente/componentes.ctrl.php" method="post">
                            <table>
                                <tr>
                                    <td>
                                        Tipo de componente:
                                        <select name="slcTipoComponente">
                                            <?php foreach ($template_slc_componentes as $valor_slc_componente => $nombre_slc_componente): ?>
                                                <option value="<?php echo $valor_slc_componente; ?>"><?php echo $nombre_slc_componente; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="Consultar"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php if (isset($template_componentes) && !empty($template_componentes)): ?>
                            <table class="general" id="tablaComponentes">
                                <thead>
                                    <tr>
                                        <?php foreach ($tamplate_nombres_columnas as $nombre_columna) : ?>
                                            <td>
                                                <?php echo $nombre_columna; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($template_componentes as $datos_componente) : ?>
                                        <tr>
                                            <?php foreach ($datos_componente as $dato_componente) : ?>
                                                <td>
                                                    <?php echo $dato_componente; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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