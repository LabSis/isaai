<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/../marco/head.tmpl.php' ?>
        <!-- CSS -->
        <link href="<?php echo $global_ruta_web; ?>/css/maquina/maquinas.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
        <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
        <script src="<?php echo $global_ruta_web; ?>/js/maquina/maquinas.js" type="text/javascript"></script>
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
                        <div ng-app="" ng-controller="ControladorMaquinas">
                            <div ng-show='maquinas.length > 0'>
                                <table class="panelOrdenacion">
                                    <tr>
                                        <td>
                                            Orden:
                                            <select class="general" ng-model="criterioOrdenacionSeleccionado" 
                                                    ng-options="criterioOrdenacion as criterioOrdenacion.valor for criterioOrdenacion in criteriosOrdenacion"
                                                    ng-change="ordenar()">
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <table class="general" id='tablaMaquinas' >
                                    <thead>
                                        <tr>
                                            <td ng-click="ordenarCabecera('id')">
                                                Nro máquina
                                            </td>
                                            <td ng-click="ordenarCabecera('nombre')">
                                                Nombre
                                            </td>
                                            <td ng-click="ordenarCabecera('nombreSistemaOperativo')">
                                                Sistema Operativo
                                            </td>
                                            <td ng-click="ordenarCabecera('fechaAlta')">
                                                Fecha de alta
                                            </td>
                                            <td ng-click="ordenarCabecera('fechaSincronizacion')">
                                                Fecha de última sincronización
                                            </td>
                                            <td ng-click="ordenarCabecera('fechaCambio')">
                                                Fecha de cambio
                                            </td>
                                            <td>
                                                Acciones
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="maquina in maquinas | orderBy : ordenTabla : ordenInvertido">
                                            <td>
                                                {{ maquina.id}}
                                            </td>
                                            <td>
                                                {{ maquina.nombre}}                                                
                                            </td>
                                            <td>
                                                {{ maquina.nombreSistemaOperativo}}
                                            </td>
                                            <td>
                                                {{ maquina.fechaAlta}}
                                            </td>
                                            <td>
                                                {{ maquina.fechaSincronizacion}}
                                            </td>
                                            <td>
                                                {{ maquina.fechaCambio}}
                                            </td>
                                            <td>
                                                <a href="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquina_detalles.ctrl.php?id={{ maquina.id}}&fecha_cambio={{ maquina.fechaCambio}}">                        
                                                    <i class="fa fa-eye fa-fw icono"></i>                            
                                                </a>
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
                            <div class='mensaje mensajeAlerta' ng-hide='maquinas.length > 0'>
                                No existen máquinas, sincronice manualmente para agregar las máquinas al sistema
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once dirname(__FILE__) . '/../marco/pie_pagina.tmpl.php' ?>
    </body>
</html>
