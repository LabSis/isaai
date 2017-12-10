<?php

require_once '../../../../config.php';

$salida = '';
$salida .= '{' . PHP_EOL;
$sesion = Sesion::get_instancia();

if ($sesion->activo()) {
    $usuario_sesion = $sesion->get_usuario();
    $accion =  $_REQUEST['accion'];
	if($usuario_sesion->es_administrador()){ //solo un usuario admin puede crear usuarios.
		if ($accion === 'consultar') {
			$salida .= '"config":{"accion": "'.$accion.'"},' . PHP_EOL;
			$salida .= '"datos":' . to_json($usuario_sesion);
		} else if($accion === 'crear') {
			$datos = $_REQUEST['datos'];
			$salida .= '"config":{"accion": "'.$accion.'", ' . PHP_EOL;		
			
			$json_usuario = json_decode($datos, true);
			if (Util::validar_nombre_usuario($json_usuario['nombreUsuario']) 
				and Util::validar_contrasenia($json_usuario['clave'])){
				$rol = new Rol();
				$rol->set_id($json_usuario['id']);
				$nuevo_usuario = new Usuario();
				$nuevo_usuario->set_nombre_usuario($json_usuario['nombreUsuario']);
				$nuevo_usuario->set_clave($json_usuario['clave']);
				$nuevo_usuario->set_rol($rol);
				$nuevo_usuario->set_nombre($json_usuario['nombre']);
				$nuevo_usuario->set_apellido($json_usuario['apellido']);
				$nuevo_usuario->set_email($json_usuario['email']);
				$nuevo_usuario->set_telefono($json_usuario['telefono']);
				$nuevo_usuario->set_direccion($json_usuario['direccion']);
				$nuevo_usuario->set_fecha_alta(Util::get_fecha_actual_formato_dd_mm_aaaa());
			}
			
			$ok = Usuario::insertar($nuevo_usuario);			
			$resultado_insercion = ($ok)?"true":"false";
			$salida .= '"resultado" : "' . $resultado_insercion . '"}, ' . PHP_EOL;
			$salida .= '"datos":' . to_json($usuario_editado);
			 
		}
	}
}
$salida .= '}' . PHP_EOL;

$file = fopen("../../../../log.txt", "w");
fwrite($file,  $salida);
fclose($file);

echo $salida;

function to_json($usuario) {
    $usuario_json = "";
    $usuario_json .= "{" . PHP_EOL;
    $usuario_json .= '"id":' . $usuario->get_id() . ',' . PHP_EOL;
    $usuario_json .= '"nombreUsuario": "' . $usuario->get_nombre_usuario() . '",' . PHP_EOL;
    //$usuario_json .= '"id_rol": ' . $usuario->get_rol()->get_id() . ',' . PHP_EOL;
    $usuario_json .= '"nombre": "' . $usuario->get_nombre() . '",' . PHP_EOL;
    $usuario_json .= '"apellido": "' . $usuario->get_apellido() . '",' . PHP_EOL;
    $usuario_json .= '"email": "' . $usuario->get_email() . '",' . PHP_EOL;
    $usuario_json .= '"telefono": "' . $usuario->get_telefono() . '",' . PHP_EOL;
    $usuario_json .= '"direccion": "' . $usuario->get_direccion() . '",' . PHP_EOL;
    $usuario_json .= '"fechaAlta": "' . $usuario->get_fecha_alta() . '",' . PHP_EOL;
    $usuario_json .= '"fechaBaja": "' . $usuario->get_fecha_baja() . '"' . PHP_EOL;
    $usuario_json .= "}" . PHP_EOL;
    return $usuario_json;
}
