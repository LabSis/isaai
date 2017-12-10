<?php

/*
 * Este controlador muestra la información referida a las máquinas.
 */
require_once '../../../config.php';

$sesion = Sesion::get_instancia();
if(!$sesion->activo()){  
	Util::ir($global_ruta_web . "/index.php");
}
$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT r.id, r.nombre "
        . "FROM roles r"
        . "ORDER BY u.nombre_usuario ASC";
$resultados = $conexion->consultar_simple($consulta);

$salida = '';
if (!empty($resultados)) {
    $salida = '{"config":{'.PHP_EOL;
    $salida .= '"consulta": "'.$consulta.'"';
    $salida .= '},' . PHP_EOL;
    $salida .= '"datos":' . PHP_EOL;
    //datos de usuarios
    $salida .= "[";
    foreach ($resultados as $resultado) {
        $salida .= '{' . PHP_EOL;
        $salida .= '"id" : "' . $resultado['id'] . '",' . PHP_EOL;
        $salida .= '"nombre" : "' . $resultado['nombre'] . '"' . PHP_EOL;
        $salida .= '}' . PHP_EOL;
        $salida .= ',';
    }
    $salida = rtrim($salida, ',');
    $salida .= ']' .PHP_EOL;
    $salida .= '}';
}
echo $salida;