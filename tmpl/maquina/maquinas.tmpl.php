<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/lib/font-awesome-4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $global_ruta_web; ?>/css/maquina/maquinas.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/sincronizar.js" type="text/javascript"></script>
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
                        <form action="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquinas.ctrl.php" method="post">
                            <table>
                                <tr>
                                    <td>
                                        Cantidad de máquinas por página:
                                        <select name="slcCantidadMaquinasPorPAgina">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="Paginar"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
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
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>