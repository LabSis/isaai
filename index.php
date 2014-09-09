<?php

require_once 'config.php';

//filtrar las maquinas que posiblemente hayan cambiado, a partir de la fecha de 
//sincornizacion
//obtener lista de ids de esas maquinas y materializarlas
//devolver lista de maquinas tanto del ocs como del isaai al controlador
$capturadorOcs = new CapturadorOcs();
$maquina = $capturadorOcs->obtenerMaquina();

echo 'velocidad del cpu: ' . $maquina->get_procesadores()->get_velocidad();
