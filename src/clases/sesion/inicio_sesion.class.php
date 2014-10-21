<?php

/**
 * Controlador para validar el inicio de sesion de un usuario.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class InicioSesion {

    /**
     * Este método recibira un nuevo usuario como parametro y lo grabara en la 
     * base de datos retornado true o 1. Si ocurre algún error devolverá false o 0
     * @param type $nuevo_usuario, tipo Usuario
     */
    public static function nueva_sesion($nuevo_usuario) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        //puedo generar la fecha de alta aca????
        $nombre_usuario = $nuevo_usuario->get_nombre_usuario();
        $clave_usuario = $nuevo_usuario->get_clave_usuario();
        $id_rol = $nuevo_usuario->get_rol();
        $nombre = $nuevo_usuario->get_nombre();
        $apellido = $nuevo_usuario->get_apellido();
        $email = is_null($nuevo_usuario->get_email()) ? null : $nuevo_usuario->get_email();
        $telefono = is_null($nuevo_usuario->get_telefono()) ? null : $nuevo_usuario->get_telefono();
        $direccion = is_null($nuevo_usuario->get_direccion()) ? null : $nuevo_usuario->get_direccion();
        $fecha_alta = $nuevo_usuario->get_fecha_alta();

        $sql = "INSERT INTO usuarios (nombre_usuario, clave_usuario, id_rol, nombre, "
                . "apellido, email, telefono, direccion, fecha_alta, fecha_baja) "
                . "VALUES ('" . $nombre_usuario . "', '" . $clave_usuario . "', " . $id_rol . ", " . $nombre . ", "
                . $apellido . ", " . $email . ", " . $telefono . ", " . $direccion . ", " . $fecha_alta . ", NULL)";

        return $conexion->insertar_simple($sql);
    }

    /**
     * Dado un nombre de usuario y una contraseña, verifica que el usuario este 
     * registrado en el sistema y que la contraseña sea correcta. Si esto se 
     * cumple devuelve el usuario, de lo contrario false ó 0
     * @param type $nombre_usuario
     * @param type $contraseña
     */
    public static function iniciar_sesion($nombre_usuario, $contraseña) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $sql = "SELECT * FROM usuarios as u WHERE u.nombre_usuario =" . $nombre_usuario
                . " and u.contraseña = " . $contraseña;
        $resultado = $conexion->consultar_simple($sql);
        if ($resultado != false) {
            $usuario = new Usuario();
            $usuario->set_nombre_usuario() = $nombre_usuario;
            $usuario->set_contraseña() = $contraseña;
            $usuario->set_nombre() = $resultado[0]['nombre'];
            $usuario->set_apellido() = $resultado[0]['apellido'];
            $usuario->set_email() = $resultado[0]['email'];
            $usuario->set_telefono() = $resultado[0]['telefono'];
            $usuario->set_direccion() = $resultado[0]['direccion'];
            $usuario->set_fecha_alta() = $resultado[0]['fecha_alta'];
            $usuario->set_fecha_baja() = $resultado[0]['fecha_baja'];
            return $usuario;
        } else {
            return false;
        }
    }

}
