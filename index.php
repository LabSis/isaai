<?php

require_once 'config.php';

$gestor_capturaciones = new GestorCapturaciones();
$gestor_capturaciones->obtener_listas();

//$cap = new CapturadorOcs();
//$idmaq = new IdMaquinaOcs(31);
//$idmaq->cargar_mapa_valores();
//$idmaq->generar_condicion_unicidad_sql();
//$maq = $cap->obtener_maquina($idmaq);
//Out::println("La velocidad del procesador es: ". $maq->get_procesadores()->get_velocidad());
