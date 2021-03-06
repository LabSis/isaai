<?php

require_once '../../../../config.php';

//parametros orden
$criterio_ordenacion = isset($_REQUEST['criterioOrdenacion']) ? $_REQUEST['criterioOrdenacion'] : 'nombre';
$orden = isset($_REQUEST['orden']) ? $_REQUEST['orden'] : 'ASC';

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT m.id, so.nombre as nombre_sistema_operativo, m.nombre, m.fecha_alta, m.fecha_sincronizacion, m.fecha_cambio "
        . "FROM maquinas m "
        . "INNER JOIN sistemas_operativos so "
        . "ON m.id_sistema_operativo = so.id "
        . "WHERE m.fecha_sincronizacion = ("
        . "     SELECT MAX(m2.fecha_sincronizacion) "
        . "     FROM maquinas m2 "
        . "     WHERE m2.id = m.id "
        . ")"
        . "ORDER BY {$criterio_ordenacion} {$orden}";
        //echo $consulta;
$resultados = $conexion->consultar_simple($consulta);

//parametros paginacion
$tamanio_pagina = (int) (isset($_REQUEST['tamanioPagina']) ? $_REQUEST['tamanioPagina'] : 10);
$cantidad_resultados = count($resultados);
$cantidad_paginas = (int) ceil($cantidad_resultados / $tamanio_pagina);
$pagina_actual = (int) (isset($_REQUEST['paginaActual']) ? $_REQUEST['paginaActual'] : 1);

//la salida originalmente era una array de maquinas cuyo length es igual al tamanio_pagina
//por lo que era capturado desde el js de angular de forma directa para setear el array de maquinas
//sin embargo, lo que necesito para paginar es la cantidad total de resultados.
//Esto se puede solucionar recibiendo todas (TODAS) los resultados de la base de datos
//y paginar todo desde el propio js, esto cargaria mucho la memoria del navegador
//por eso se decidio hacer que la salida devuelva tambien datos de configuración del angular
//como ser la cantidad de resultados.
$salida = '';
if (!empty($resultados)) {
    //paginacion
    $resultados = Util::paginar($resultados, $pagina_actual, $tamanio_pagina);
    //armo la salida de objetos json
    //datos de configuration
    $salida = '{"config":{'.PHP_EOL;
    $salida .= '"cantidadResultados": "'.$cantidad_resultados.'",' . PHP_EOL;
    $salida .= '"cantidadPaginas": "'.$cantidad_paginas.'",' . PHP_EOL;
    $salida .= '"consulta": "'.$consulta.'"';
    $salida .= '},' . PHP_EOL;
    $salida .= '"datos":' . PHP_EOL;
    //datos de maquinas
    $salida .= "[";
    foreach ($resultados as $resultado) {
        $salida .= '{' . PHP_EOL;
        $salida .= '"id" : "' . $resultado['id'] . '",' . PHP_EOL;
        $salida .= '"nombre" : "' . $resultado['nombre'] . '",' . PHP_EOL;
        $salida .= '"nombreSistemaOperativo" : "' . $resultado['nombre_sistema_operativo'] . '",' . PHP_EOL;
        $salida .= '"fechaAlta" : "' . $resultado['fecha_alta'] . '",' . PHP_EOL;
        $salida .= '"fechaSincronizacion" : "' . $resultado['fecha_sincronizacion'] . '",' . PHP_EOL;
        $salida .= '"fechaCambio" : "' . $resultado['fecha_cambio'] . '"' . PHP_EOL;
        $salida .= '}' . PHP_EOL;
        $salida .= ',';
    }
    $salida = rtrim($salida, ',');
    $salida .= ']' .PHP_EOL;
    $salida .= '}';
}
echo $salida;
