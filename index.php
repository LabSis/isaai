<?php

require_once 'config.php';

//$gestor_capturaciones = new GestorCapturaciones();
//$gestor_capturaciones->capturar();

$capturadorOcs = new CapturadorOcs();
$idMaquinaOcs = new IdMaquinaOcs(227);
$maquina = $capturadorOcs->obtenerMaquina($idMaquinaOcs);
echo '<br/>'.$maquina->get_procesadores()->get_velocidad();
