<?php

require_once '../../../../config.php';

$salida = '';
$salida .= '{' . PHP_EOL;
$salida .= '"config":{},' . PHP_EOL;
$salida .= '"datos":{' . PHP_EOL;
$sesion = Sesion::get_instancia();
if($sesion->activo()){
    $usuario = $sesion->get_usuario();
    $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'consultar';
    if($accion == 'consultar'){
        $salida .= '"id":'.$usuario->get_id() .',' . PHP_EOL;
        $salida .= '"nombreUsuario": "'.$usuario->get_nombre_usuario() .'",' . PHP_EOL;
        //$salida = '"clave_usuario": "'.$usuario->get_clave_usuario() .'",' . PHP_EOL;
        $salida .= '"id_rol": '.$usuario->get_rol()->get_id() .',' . PHP_EOL;
        $salida .= '"nombre": "'.$usuario->get_nombre() .'",' . PHP_EOL;
        $salida .= '"apellido": "'.$usuario->get_apellido() .'",' . PHP_EOL;
        $salida .= '"email": "'.$usuario->get_email() .'",' . PHP_EOL;
        $salida .= '"telefono": "'.$usuario->get_telefono() .'",' . PHP_EOL;
        $salida .= '"direccion": "'.$usuario->get_direccion() .'",' . PHP_EOL;
        $salida .= '"fechaAlta": "'.$usuario->get_fecha_alta() .'",' . PHP_EOL;
        $salida .= '"fechaBaja": "'.$usuario->get_fecha_baja() .'"' . PHP_EOL;
    }else if($accion == 'modificar'){
        Usuario::modificar();
    }
}
$salida .= '}' . PHP_EOL;
$salida .= '}' . PHP_EOL;
echo $salida;
/*
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
*/