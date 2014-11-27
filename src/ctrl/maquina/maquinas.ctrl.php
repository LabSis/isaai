<?php

/*
 * Este controlador muestra la información referida a las máquinas.
 */
require_once '../../../config.php';

$template_maquinas = array();
$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT m.id, so.nombre as nombre_sistema_operativo, m.nombre, m.fecha_alta, m.fecha_sincronizacion, m.fecha_cambio "
        . "FROM maquinas m "
        . "INNER JOIN sistemas_operativos so "
        . "ON m.id_sistema_operativo = so.id";
$resultados = $conexion->consultar_simple($consulta);
foreach ($resultados as $maquina) {
    $template_maquinas[] = $maquina;
}
//Out::print_array($template_maquinas);

require_once $global_ruta_servidor . '/tmpl/maquina/maquinas.tmpl.php';
