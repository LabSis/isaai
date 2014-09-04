<?php

require_once 'config.php';

$capturadorOcs = new CapturadorOcs();
$maquina = $capturadorOcs->obtenerMaquina();

echo 'velocidad del cpu: ' . $maquina->get_procesador()->get_velocidad();