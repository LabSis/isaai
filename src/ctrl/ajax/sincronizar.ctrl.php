<?php

require_once '../../../config.php';

$gestor_capturaciones = new GestorCapturaciones();
$maquinas = @$gestor_capturaciones->obtener_listas();
//print_r($maquinas);
$gestor_comparaciones = new GestorComparaciones();
$cambios = @$gestor_comparaciones->obtener_cambios($maquinas[0], $maquinas[1], $maquinas[2]);

echo count($cambios);

//Out::println("Los cambios encontrados son " . count($cambios));
//Out::print_array($cambios);

//$gestor_comunicaciones = new GestorComunicaciones();