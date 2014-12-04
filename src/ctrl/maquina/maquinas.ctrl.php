<?php

/*
 * Este controlador muestra la información referida a las máquinas.
 */
require_once '../../../config.php';

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT m.id, so.nombre as nombre_sistema_operativo, m.nombre, m.fecha_alta, m.fecha_sincronizacion, m.fecha_cambio "
        . "FROM maquinas m "
        . "INNER JOIN sistemas_operativos so "
        . "ON m.id_sistema_operativo = so.id "
        . "ORDER BY m.nombre ASC";
$resultados = $conexion->consultar_simple($consulta);
$tamanio_pagina = (int) (isset($_GET['tamanio_pagina']) ? $_GET['tamanio_pagina'] : 5);
$cantidad_resultados = count($resultados);
$cantidad_paginas = (int) ceil($cantidad_resultados / $tamanio_pagina);
$pagina_actual = (int) (isset($_GET['pagina']) ? $_GET['pagina'] : 1);
$template_maquinas = Util::paginar($resultados, $pagina_actual, $tamanio_pagina);

//Out::print_array($template_maquinas);

require_once $global_ruta_servidor . '/tmpl/maquina/maquinas.tmpl.php';
