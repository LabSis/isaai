<?php
/*
 * Este controlador actualiza el rol de un usuario del sistema.
 */
require_once '../../../config.php';

$sesion = Sesion::get_instancia();
if(!$sesion->activo()){  
	Util::ir($global_ruta_web . "/index.php");
}
if(!$sesion->get_usuario()->es_administrador()){
	Util::ir($global_ruta_web . "/index.php");
}

$salida = '';
$salida .= '{' . PHP_EOL;
if (filter_has_var(INPUT_POST, 'datos')) {
	$resultado = "false";
	$datos = $_REQUEST['datos'];
	$json_datos_usuario = json_decode($datos, true);
	$nuevo_rol = new Rol();
	$nuevo_rol->set_id($json_datos_usuario['idRol'])
    $usuario = new Usuario();
	$usuario->set_nombre_usuario($json_datos_usuario['nombreUsuario']);
	$usuario->set_rol($nuevo_rol);
	//$conexion = Conexion::get_instacia(CONEXION_ISAAI);
	if(Usuario::actualizar_rol($usuario)){
        $resultado = "true";
	}
    $salida .= '"resultado": "' . $resultado . '"' . PHP_EOL;
}
$salida .= '}';
echo $salida;