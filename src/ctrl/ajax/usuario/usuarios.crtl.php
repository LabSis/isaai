<?php

/*
 * Este controlador muestra la información referida a los usuarios del sistema.
 */
require_once '../../../config.php';

$sesion = Sesion::get_instancia();
if(!$sesion->activo()){  
	Util::ir($global_ruta_web . "/index.php");
}
if(!$sesion->get_usuario()->es_administrador()){
	Util::ir($global_ruta_web . "/index.php");
}
$criterio_ordenacion = isset($_REQUEST['criterioOrdenacion']) ? $_REQUEST['criterioOrdenacion'] : 'nombreUsuario';
$orden = isset($_REQUEST['orden']) ? $_REQUEST['orden'] : 'ASC';

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT u.id, u.nombre_usuario, r.id as id_rol"
        . "FROM usuarios u"
        . "ORDER BY u.nombre_usuario ASC";
$resultados = $conexion->consultar_simple($consulta);


$tamanio_pagina = (int) (isset($_REQUEST['tamanioPagina']) ? $_REQUEST['tamanioPagina'] : 10);
$cantidad_resultados = count($resultados);
$cantidad_paginas = (int) ceil($cantidad_resultados / $tamanio_pagina);
$pagina_actual = (int) (isset($_REQUEST['paginaActual']) ? $_REQUEST['paginaActual'] : 1);

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
    //datos de usuarios
    $salida .= "[";
    foreach ($resultados as $resultado) {
        $salida .= '{' . PHP_EOL;
        $salida .= '"idRol" : "' . $resultado['id_rol'] . '",' . PHP_EOL;
        $salida .= '"nombreUsuario" : "' . $resultado['nombre_usuario'] . '"' . PHP_EOL;
        $salida .= '}' . PHP_EOL;
        $salida .= ',';
    }
    $salida = rtrim($salida, ',');
    $salida .= ']' .PHP_EOL;
    $salida .= '}';
}
echo $salida;