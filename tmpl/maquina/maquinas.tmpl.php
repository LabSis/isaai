<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/maquina/maquinas.css" type="text/css" rel="stylesheet"/>
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
                        Todas las máquinas
                    </h2>
                    <div class='contenidoSeccion'>
                        <form action="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquinas.ctrl.php" method="get">
                            <table>
                                <tr>
                                    <td>
                                        Páginas:
                                        <?php if (!empty($template_maquinas) && $cantidad_paginas > 1): ?>
                                            <?php for ($p = 1; $p <= $cantidad_paginas; $p++): ?>
                                                <div class="pagina">
                                                    <a href="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquinas.ctrl.php?pagina=<?php echo $p; ?>">
                                                        <?php echo $p; ?>
                                                    </a>
                                                </div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php if (isset($template_maquinas) && !empty($template_maquinas)): ?>
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
                                            Sistema Operativo
                                        </td>
                                        <td>
                                            Fecha alta
                                        </td>
                                        <td>
                                            Fecha última sincronización
                                        </td>
                                        <td>
                                            Fecha cambio
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
                                                <a href="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquina_detalles.ctrl.php?id=<?php echo $maquina['id']; ?>&fecha_cambio=<?php echo $maquina['fecha_cambio']; ?>">
                                                    <?php echo $maquina['nombre']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $maquina['nombre_sistema_operativo']; ?>
                                            </td>
                                            <td>
                                                <?php echo $maquina['fecha_alta']; ?>
                                            </td>
                                            <td>
                                                <?php echo $maquina['fecha_sincronizacion']; ?>
                                            </td>
                                            <td>
                                                <?php echo $maquina['fecha_cambio']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="mensaje mensajeAlerta">
                                No existen máquinas en el sistema, sincronize para actualziar el listado
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>