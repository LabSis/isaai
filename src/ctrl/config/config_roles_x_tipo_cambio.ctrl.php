<?php

require_once '../../../config.php';

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$resultados = $conexion->consultar_simple("SELECT id, nombre, descripcion FROM roles");
$roles = array();
if (!empty($resultados)) {
    foreach ($resultados as $fila_resultado) {
        $roles[] = new Rol($fila_resultado['id'], $fila_resultado['nombre'], $fila_resultado['descripcion']);
    }
}

$resultados = $conexion->consultar_simple("SELECT id, nombre, descripcion FROM tipos_cambio");
$tipos_cambio = array();
if (!empty($resultados)) {
    foreach ($resultados as $fila_resultado) {
        $tipo_cambio = new TipoCambio();
        $tipo_cambio->set_id($fila_resultado['id']);
        $tipo_cambio->set_nombre($fila_resultado['nombre']);
        $tipo_cambio->set_descripcion($fila_resultado['descripcion']);
        $tipos_cambio[] = $tipo_cambio;
    }
}

$resultados = $conexion->consultar_simple("SELECT id_rol, id_tipo_cambio, permiso FROM roles_x_tipo_cambio");
$matriz = array();

if (!empty($resultados)) {
    foreach ($resultados as $fila_resultado) {
        if (!isset($matriz[$fila_resultado['id_rol']])) {
            $matriz[$fila_resultado['id_rol']] = array();
        }
        $matriz[$fila_resultado['id_rol']][$fila_resultado['id_tipo_cambio']] = $fila_resultado['permiso'];
    }
}

require_once $global_ruta_servidor . '/tmpl/config/config_roles_x_tipo_cambio.tmpl.php';
