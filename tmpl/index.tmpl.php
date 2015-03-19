<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="css/index.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
    </head>
    <body>
        <?php require_once dirname(__FILE__) . '/marco/cabecera.tmpl.php' ?>
        <main>
            <div id="contenido">
                <form action="index.php" id="frmIngreso" method="post">
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
                                <input type="submit" value="Ingresar" name="btnIngresar" class="boton" id="btnIngresar"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php require_once dirname(__FILE__) . '/general/mensajes.tmpl.php' ?>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>