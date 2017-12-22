<?php
/*
 * Este controlador actualiza el rol de un usuario del sistema.
 */
require_once '../../../../config.php';

$sesion = Sesion::get_instancia();
if(!$sesion->activo()){  
	Util::ir($global_ruta_web . "/index.php");
}
if(!$sesion->get_usuario()->es_administrador()){
	Util::ir($global_ruta_web . "/index.php");
}

$salida = '';
$salida .= '{' . PHP_EOL;
$request = json_decode(file_get_contents('php://input'), true);
$json_datos_usuario = $request['datos'];
$resultado = "false";
$usuario = new Usuario();
$usuario->set_nombre_usuario($json_datos_usuario['nombreUsuario']);
$usuario->set_rol(new Rol($json_datos_usuario['idRol'], null, null));
if(Usuario::cantidad_administradores_excepto($usuario->get_nombre_usuario()) >= 1 
	&& !$usuario->es_usuario($sesion->get_usuario()->get_nombre_usuario())){
	if(Usuario::actualizar_rol($usuario)){
		$resultado = "true";
	}	
}
$salida .= '"resultado": "' . $resultado . '"' . PHP_EOL;
$salida .= '}';
echo $salida;