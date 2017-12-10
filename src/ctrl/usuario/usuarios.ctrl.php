<?php

/*
 * Este controlador muestra la información referida a las máquinas.
 */
require_once '../../../config.php';

$sesion = Sesion::get_instancia();
if(!$sesion->activo()){  
	Util::ir($global_ruta_web . "/index.php");
}
if(!$sesion->get_usuario()->es_administrador()){
	Util::ir($global_ruta_web . "/index.php");
}
require_once $global_ruta_servidor . '/tmpl/usuario/usuarios.tmpl.php';
