<?php

/**
 * Representa un sistema operativo.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class SistemaOperativo {

    private $_id;
    private $_nombre;   //255 caracteres como limite
    private $_version;  //50 caracteres como limite

    function __construct($_id, $_nombre, $_version) {
        $this->_id = $_id;
        $this->_nombre = $_nombre;
        $this->_version = $_version;
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

    public function get_version() {
        return $this->_version;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_version($_version) {
        $this->_version = $_version;
    }

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT so.id, so.nombre, so.version FROM sistemas_operativos AS so INNER JOIN maquinas AS m ON so.id = m.id_sistema_operativo WHERE m.id = '{$id_maquina->get_id_hash()}'";
        $resultado = $conexion->consultar_simple($consulta);
        $sistema_operativo = new SistemaOperativo($resultado[0]["id"], $resultado[0]["nombre"], $resultado[0]["version"]);
        return $sistema_operativo;
    }

    public function insertar() {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos = array(
            "id" => $this->_id,
            "nombre" => $this->_nombre,
            "version" => $this->_version
        );
        return $conexion->insertar("sistemas_operativos", $datos);
    }
    
    public function equals($sistema_operativo) {
        $igual = true;
        $igual &= $this->_nombre == $sistema_operativo->get_nombre();
        $igual &= $this->_version == $sistema_operativo->get_version();
        return $igual;
    }

}
