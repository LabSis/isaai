<?php
require_once '../../../config.php';

$sesion = Sesion::get_instancia();
if($sesion->activo()){  
	if(!$sesion->get_usuario()->es_administrador()){
		Util::ir($global_ruta_web . "/index.php");
	}
}
require_once $global_ruta_servidor . '/tmpl/usuario/crear_usuario.tmpl.php';