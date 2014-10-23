<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once $global_ruta_servidor . '/tmpl/marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/index.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
    </head>
    <body>
        <?php require_once $global_ruta_servidor . '/tmpl/marco/cabecera.tmpl.php' ?>
        <main>
            <div id="contenido">
                <form action="<?php echo $global_ruta_web; ?>/index.php" id="frmIngreso" method="post">
                    <table>
                        <tr>
                            <td >
                                Nombre de usuario:
                            </td>
                            <td>
                                <input type="text" name="txtNombre" class="general"/>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                Clave:
                            </td>
                            <td>
                                <input type="password" name="txtClave" class="general"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Ingresar" name="btnIngresar" class="boton"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php require_once $global_ruta_servidor . '/tmpl/general/mensajes.tmpl.php' ?>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once $global_ruta_servidor . '/tmpl/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>