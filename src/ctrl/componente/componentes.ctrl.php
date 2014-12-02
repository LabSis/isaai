<?php

require_once '../../../config.php';

$template_componentes = array();

$template_slc_componentes = array(
    "1" => "Bios",
    "2" => "Disco",
    "3" => "Memoria",
    "4" => "Monitor",
    "5" => "Periférico",
    "6" => "Placa de red",
    "7" => "Placa de sonido",
    "8" => "Placa de video",
    "9" => "Procesador"
);

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT b.id, m.nombre as nombre_maquina, b.id_maquina, b.nombre, b.fabricante, b.modelo, b.asset_tag, b.version, b.numero_serial "
        . "FROM bios b "
        . "INNER JOIN maquinas m "
        . "ON b.id_maquina = m.id "
        . "ORDER BY b.id";
$resultados = $conexion->consultar_simple($consulta);
$tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Fabricante", "Modelo", "Version", "Número de serie");
foreach ($resultados as $componente) {
    $template_componentes[] = array(
        $componente['nombre_maquina'],
        $componente['id'],
        $componente['nombre'],
        $componente['fabricante'],
        $componente['modelo'],
        $componente['version'],
        $componente['numero_serial']
    );
}
//Out::print_array($template_componentes);

require_once $global_ruta_servidor . '/tmpl/componente/componentes.tmpl.php';
