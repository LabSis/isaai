<?php

require_once '../../../../config.php';

//parametros orden
$criterio_ordenacion = isset($_REQUEST['criterio_ordenacion']) ? $_REQUEST['criterio_ordenacion'] : 'nombre';
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
$resultados = $conexion->consultar_simple($consulta);

//parametros paginacion
$tamanio_pagina = (int) (isset($_REQUEST['tamanio_pagina']) ? $_REQUEST['tamanio_pagina'] : 10);
$cantidad_resultados = count($resultados);
$cantidad_paginas = (int) ceil($cantidad_resultados / $tamanio_pagina);
$pagina_actual = (int) (isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 1);

$salida = '';
if (!empty($resultados)) {
    //paginacion
    $resultados = Util::paginar($resultados, $pagina_actual, $tamanio_pagina);
    //armo la salida de objetos json
    $salida = "[";
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
    $salida .= ']';
}
echo $salida;
