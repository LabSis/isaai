<?php

/*
 * Este controlador genera la sincronización del sistema ISAAI con el OCS.
 */
require_once '../../config.php';

$gestor_capturaciones = new GestorCapturaciones();
$maquinas = $gestor_capturaciones->obtener_listas();

$gestor_comparaciones = new GestorComparaciones();
$cambios = $gestor_comparaciones->obtener_cambios($maquinas[0], $maquinas[1], $maquinas[2]);

//$gestor_comunicaciones = new GestorComunicaciones();
//$alertadores[] = new AlertadorEmail();
//$gestor_comunicaciones->alertar($cambios, $alertadores);
Out::println("Los cambios encontrados son " . count($cambios));
//Out::print_array($cambios);

//$gestor_comunicaciones = new GestorComunicaciones();