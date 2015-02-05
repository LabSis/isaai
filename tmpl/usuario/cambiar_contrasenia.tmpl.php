<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/usuario/editar_datos.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
        <script src="<?php echo $global_ruta_web; ?>/js/usuario/cambiar_contrasenia.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Editar datos
                    </h2>
                    <div class='contenidoSeccion' >
                        <div ng-app="" ng-controller="ControladorCambiarContrasenia">
                            <form action="" id="frmCambiarContrasenia" method="post">
                                <table id='tablaEditarDatos' class='formulario'>
                                    <tr>
                                        <td>
                                            Contraseña actual:
                                        </td>
                                        <td>
                                            <input type="password" name="txtNombre" ng-model="usuario.claveActual" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nueva contraseña:
                                        </td>
                                        <td>
                                            <input type="password" name="txtApellido" ng-model="usuario.nuevaClave" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Repita la nueva contraseña:
                                        </td>
                                        <td>
                                            <input type="password" name="txtApellido" ng-model="usuario.repeticionNuevaClave" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="button" value="Aceptar" ng-click="cambiarContrasenia()" name="btnAceptar" id='btnAceptar' class="boton"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <?php require_once dirname(__FILE__) . '/../general/mensajes.tmpl.php' ?>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>
