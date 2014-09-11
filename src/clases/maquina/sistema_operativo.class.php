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

}
