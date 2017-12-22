<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/maquina/maquinas.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
        <script src="<?php echo $global_ruta_web; ?>/js/usuario/usuarios.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="data" id="dataRutaWeb"><?php echo $global_ruta_web; ?></div>
        <?php require_once dirname(__FILE__) . '/../marco/cabecera.tmpl.php' ?>
        <main>
            <?php require_once dirname(__FILE__) . '/../marco/menu_principal.tmpl.php' ?>
            <div id="contenido">
                <div class='seccion'>
                    <h2 class='titulo tituloSeccion'>
                        Todas los usuarios
                    </h2>
                    <div class='contenidoSeccion'>
                        <div ng-app="" ng-controller="ControladorUsuarios">
                            <div ng-show='usuarios.length > 0'>
                                <table class="general" id='tablaMaquinas' >
                                    <thead>
                                        <tr>
                                            <td ng-click="ordenarCabecera('nombreUsuario')">
                                                Usuario
                                            </td>
                                            <td>
                                                Rol
                                            </td>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="usuario in usuarios | orderBy : ordenTabla : ordenInvertido">
                                            <td>
                                                {{ usuario.nombreUsuario}}
                                            </td>
                                            <td>
												<select class="general" ng-model="usuario.idRol" 
														ng-options="rol.id as rol.nombre for rol in roles"
														ng-change="actualizarRol(usuario, '{{usuario.idRol}}')">
												</select>												
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="panelPaginacion">
                                    <tr>
                                        <td>
                                            Páginas:
                                        </td>
                                        <td>
                                            <div class="pagina" ng-repeat="p in paginado">
                                                <a ng-click="paginar(p)">
                                                    <span style="font-weight: bold" ng-if="p == params.paginaActual">
                                                        {{ p}}
                                                    </span>
                                                    <span ng-if="p != params.paginaActual">
                                                        {{ p}}
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="clearer"></div>
                            </div>
                            <div class='mensaje mensajeAlerta' ng-hide='usuarios.length > 0'>
                                No existen usuarios.
                            </div>
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
