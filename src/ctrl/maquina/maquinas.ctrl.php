<?php

/*
 * Este controlador muestra la información referida a las máquinas.
 */
require_once '../../../config.php';

$template_maquinas = array();
$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$limite = 1000;
$id_busqueda_desde = 'a7d34f432804d18e6d24c182dc8303a4';
if (isset($_POST['slcCantidadMaquinasPorPAgina'])) {
    $limite = $_POST['slcCantidadMaquinasPorPAgina'];
}
if (isset($_REQUEST['id_maquina_desde'])) {
    $id_busqueda_desde = $_REQUEST['id_maquina_desde'];
}
$consulta = "SELECT m.id, so.nombre as nombre_sistema_operativo, m.nombre, m.fecha_alta, m.fecha_sincronizacion, m.fecha_cambio "
        . "FROM maquinas m "
        . "INNER JOIN sistemas_operativos so "
        . "ON m.id_sistema_operativo = so.id "
        //. "WHERE m.id = '{$id_busqueda_desde}' "
        . "ORDER BY m.nombre ASC "
        . "LIMIT {$limite}";
$resultados = $conexion->consultar_simple($consulta);
foreach ($resultados as $maquina) {
    $template_maquinas[] = $maquina;
}
//Out::print_array($template_maquinas);

require_once $global_ruta_servidor . '/tmpl/maquina/maquinas.tmpl.php';
