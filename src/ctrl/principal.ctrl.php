<?php

/*
 * Este controlador muestra la información principal del usuario.
 */
require_once '../../config.php';

$template_maquinas = array();
$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$resultados = $conexion->consultar_simple("SELECT * FROM maquinas");
foreach($resultados as $maquina){
   $template_maquinas[] = $maquina;
}
//Out::print_array($template_maquinas);

require_once $global_ruta_servidor . '/tmpl/principal.tmpl.php';