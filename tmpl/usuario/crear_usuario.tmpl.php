<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/usuario/editar_datos.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
        <script src="<?php echo $global_ruta_web; ?>/js/usuario/crear_usuario.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Crear usuario
                    </h2>
                    <div class='contenidoSeccion' >
                        <div ng-app="" ng-controller="ControladorCrearUsuario">
                            <form action="<?php echo $global_ruta_web ?>/src/ctrl/usuario/crear_usuario.ctrl.php" id="frmEditarDatos" method="post">
                                <table id='tablaEditarDatos' class='formulario'>
                                    <tr>
                                        <td >
                                            Nombre de usuario (*):
                                        </td>
                                        <td>
                                            <input type="text" name="txtNombreUsuario" ng-model="usuario.nombreUsuario" class="general"/>
                                        </td>
                                    </tr>
									<tr>
                                        <td >
                                            Contraseña (*):
                                        </td>
                                        <td>
                                            <input type="password" name="txtNombreUsuario" ng-model="usuario.clave" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nombre:
                                        </td>
                                        <td>
                                            <input type="text" name="txtNombre" ng-model="usuario.nombre" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Apellido:
                                        </td>
                                        <td>
                                            <input type="text" name="txtApellido" ng-model="usuario.apellido" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Rol:
                                        </td>
                                        <td>
                                            <select class='general'>
                                                <option>Administrador</option>
                                                <option>Operador</option>
                                                <option>Técnico</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email:
                                        </td>
                                        <td>
                                            <input type="text" name="txtEmail" ng-model="usuario.email" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Teléfono:
                                        </td>
                                        <td>
                                            <input type="text" name="txtTelefono" ng-model="usuario.telefono" class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Dirección:
                                        </td>
                                        <td>
                                            <input type="text" name="txtDireccion" ng-model="usuario.direccion"  class="general"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="button" value="Aceptar" ng-click="crearUsuario()" name="btnAceptar" id='btnAceptar' class="boton"/>
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
