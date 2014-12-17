<?php

/**
 * Respresenta un rol de usuario para nuestro sistema. Como ser: Admisnitrador, 
 * Operador, Técnico, etc.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Rol {

    private $_id;
    private $_nombre;
    private $_descripcion;

    function __construct($_id, $_nombre, $_descripcion) {
        $this->_id = $_id;
        $this->_nombre = $_nombre;
        $this->_descripcion = $_descripcion;
    }

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public static function determinar_roles_mensaje($tipo_cambio) {
        $roles = array();
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT r.id, r.nombre, r.descripcion "
                . "FROM roles AS r INNER JOIN roles_x_tipo_cambio AS rtc "
                . "ON r.id = rtc.id_rol "
                . "WHERE rtc.id_tipo_cambio = {$tipo_cambio->get_id()} and rtc.permiso = true";
        $resultados = $conexion->consultar_simple($consulta);
        for ($i = 0; $i < count($resultados); $i++) {
            $rol = new Rol($resultados[$i]['id'], $resultados[$i]['nombre'], $resultados[$i]['descripcion']);
            $roles[] = $rol;
        }
        return $roles;
    }

}
