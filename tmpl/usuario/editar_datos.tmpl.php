<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/usuario/editar_datos.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src="<?php echo $global_ruta_web; ?>/js/usuario/editar_datos.css" type="text/javascript"></script>
    </head>
    <body>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Editar datos
                    </h2>
                    <div class='contenidoSeccion'>
                        <form action="<?php echo $global_ruta_web ?>/src/ctrl/usuario/editar_datos.ctrl.php" id="frmEditarDatos" method="post">
                            <table id='tablaEditarDatos' class='formulario'>
                                <tr>
                                    <td >
                                        Nombre de usuario:
                                    </td>
                                    <td>
                                        <input type="text" name="txtNombreUsuario" value="<?php echo $usuario->get_nombre_usuario();?>" class="general" />
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Clave:
                                    </td>
                                    <td>
                                        <input type="password" name="txtClave" value="" class="general"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nombre:
                                    </td>
                                    <td>
                                        <input type="text" name="txtNombre" value="<?php echo $usuario->get_nombre();?>" class="general"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Apellido:
                                    </td>
                                    <td>
                                        <input type="text" name="txtApellido" value="<?php echo $usuario->get_apellido();?>" class="general"/>
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
                                        <input type="text" name="txtEmail" value="<?php echo $usuario->get_email();?>" class="general"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Teléfono:
                                    </td>
                                    <td>
                                        <input type="text" name="txtTelefono" value="<?php echo $usuario->get_telefono();?>" class="general"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Dirección:
                                    </td>
                                    <td>
                                        <input type="text" name="txtDireccion" value="<?php echo $usuario->get_direccion();?>"  class="general"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" value="Aceptar" name="btnAceptar" id='btnAceptar' class="boton"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <?php require_once dirname(__FILE__) . '/../general/mensajes.tmpl.php' ?>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>
