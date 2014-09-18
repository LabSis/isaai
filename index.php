<?php

require_once 'config.php';

$gestor_capturaciones = new GestorCapturaciones();
$gestor_capturaciones->obtener_listas();

//$id_maquina_ocs = new IdMaquinaOcs(31);
//echo $id_maquina_ocs->get_id_hash();
