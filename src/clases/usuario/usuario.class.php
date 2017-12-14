<?php

/**
 * Representa un usuario de nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Usuario {

    private $_id;
    private $_nombre_usuario;
    private $_clave_usuario;
    private $_rol;
    private $_nombre;
    private $_apellido;
    private $_email;
    private $_telefono;
    private $_direccion;
    private $_fecha_alta;
    private $_fecha_baja;

    function __construct() {
        $this->_id = NULL;
        $this->_nombre_usuario = NULL;
        $this->_clave_usuario = NULL;
        $this->_rol = NULL;
        $this->_nombre = NULL;
        $this->_apellido = NULL;
        $this->_email = NULL;
        $this->_telefono = NULL;
        $this->_direccion = NULL;
        $this->_fecha_alta = NULL;
        $this->_fecha_baja = NULL;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_nombre_usuario() {
        return $this->_nombre_usuario;
    }

    public function get_clave_usuario() {
        return $this->_clave_usuario;
    }

    public function get_rol() {
        return $this->_rol;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_apellido() {
        return $this->_apellido;
    }

    public function get_email() {
        return $this->_email;
    }

    public function get_telefono() {
        return $this->_telefono;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function get_fecha_baja() {
        return $this->_fecha_baja;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_fecha_baja($_fecha_baja) {
        $this->_fecha_baja = $_fecha_baja;
    }

    public function set_nombre_usuario($_nombre_usuario) {
        $this->_nombre_usuario = $_nombre_usuario;
    }

    public function set_clave_usuario($_clave_usuario) {
        $this->_clave_usuario = $_clave_usuario;
    }

    public function set_rol($_rol) {
        $this->_rol = $_rol;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_apellido($_apellido) {
        $this->_apellido = $_apellido;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }
	
	public function es_administrador(){
		return $this->_rol->es_administrador();
	}

    /**
     * Este método recibira un nuevo usuario como parametro y lo grabara en la 
     * base de datos retornado true o 1. Si ocurre algún error devolverá false o 0
     * @param type $nuevo_usuario, tipo Usuario
     */
    public static function insertar($nuevo_usuario) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $nombre_usuario = $nuevo_usuario->get_nombre_usuario();
        $clave_usuario = $nuevo_usuario->get_clave_usuario();
        $id_rol = $nuevo_usuario->get_rol()->get_id();
        $nombre = $nuevo_usuario->get_nombre();
        $apellido = $nuevo_usuario->get_apellido();
        $email = empty($nuevo_usuario->get_email()) ? 'NULL' : "'" . $nuevo_usuario->get_email() ."'";
        $telefono = empty($nuevo_usuario->get_telefono()) ? 'NULL' : "'" . $nuevo_usuario->get_telefono() ."'";
        $direccion = empty($nuevo_usuario->get_direccion()) ? 'NULL' : "'" . $nuevo_usuario->get_direccion() ."'";
        $fecha_alta = $nuevo_usuario->get_fecha_alta();

        $sql = "INSERT INTO usuarios (nombre_usuario, clave_usuario, id_rol, nombre, "
                . "apellido, email, telefono, direccion, fecha_alta, fecha_baja) "
                . "VALUES ('" . $nombre_usuario . "', MD5('{$clave_usuario}'), " . $id_rol . ", '" . $nombre . "', '"
                . $apellido . "', " . $email .	", " . $telefono . ", " . $direccion . ", '" . $fecha_alta . "', NULL)";
        return $conexion->insertar_simple($sql);
    }

    public static function actualizar($usuario) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos = array(
            "nombre_usuario" => $usuario->get_nombre_usuario(),
            "clave_usuario" => md5($usuario->get_clave_usuario()),
            "nombre" => $usuario->get_nombre(),
            "apellido" => $usuario->get_apellido(),
            "id_rol" => (($usuario->get_rol() != null) ? $usuario->get_rol()->get_id() : null),
            "email" => $usuario->get_email(),
            "telefono" => $usuario->get_telefono(),
            "direccion" => $usuario->get_direccion(),
            "fecha_alta" => $usuario->get_fecha_alta(),
            "fecha_baja" => $usuario->get_fecha_baja(),
        );
        return $conexion->actualizar_unico("usuarios", $datos, "id", $usuario->get_id());
    }
	
	public static function actualizar_rol($usuario) {
		if ($usuario->get_rol() == NULL){
			return FALSE;
		}
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos = array(
            "id_rol" => $usuario->get_rol()->get_id(),            
        );
		$filtro = array('campo' => "nombre_usuario", 'filtro' => Conexion::FILTRO_BUSQUEDA_COINCIDIR_STRING_COMPLETO, 'valor' => $usuario->get_nombre_usuario());
        return $conexion->actualizar("usuarios", $datos, array($filtro));
    }

    /**
     * Este método recibirá un objeto rol, y devolverá un array de usuarios que 
     * esten registrados en la base de datos y que pertenezcan a ese rol.Cada 
     * usuario tendrá cargado solo nombre_usuario, nombre, apellido, email y 
     * telefono, que son los atributos mínimos necesarios para enviarles notificaciones.
     * @param type $rol
     */
    public static function determinar_usuarios_a_enviar($id_rol) {
        $usuarios = array();
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT u.nombre_usuario, u.nombre, u.apellido, u.email, u.telefono "
                . "FROM usuarios AS u WHERE u.id_rol ={$id_rol}";
        $resultado = $conexion->consultar_simple($consulta);
        for ($i = 0; $i < count($resultado); $i++) {
            $usuario = new Usuario();
            $usuario->set_nombre_usuario($resultado[$i]['nombre_usuario']);
            $usuario->set_nombre($resultado[$i]['nombre']);
            $usuario->set_apellido($resultado[$i]['apellido']);
            $usuario->set_email($resultado[$i]['email']);
            $usuario->set_telefono($resultado[$i]['telefono']);
            $usuario->set_rol(new Rol($id_rol, null, null));
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    public static function materializar($id) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT id, nombre_usuario, clave_usuario, id_rol, nombre, apellido, email, telefono, direccion, fecha_alta, fecha_baja "
                . "FROM usuarios "
                . "WHERE id = {$id} ";
        $resultado = $conexion->consultar_simple($consulta);
        if (!empty($resultado)) {
            $usuario = new Usuario();
            $usuario->set_id($resultado[0]['id']);
            $usuario->set_nombre_usuario($resultado[0]['nombre_usuario']);
            $usuario->set_clave_usuario($resultado[0]['clave_usuario']);
            $usuario->set_rol(Rol::materializar($resultado[0]['id_rol']));
            $usuario->set_nombre($resultado[0]['nombre']);
            $usuario->set_apellido($resultado[0]['apellido']);
            $usuario->set_email($resultado[0]['email']);
            $usuario->set_telefono($resultado[0]['telefono']);
            $usuario->set_direccion($resultado[0]['direccion']);
            $usuario->set_fecha_alta($resultado[0]['fecha_alta']);
            $usuario->set_fecha_baja($resultado[0]['fecha_baja']);
            return $usuario;
        }
        return null;
    }

}
