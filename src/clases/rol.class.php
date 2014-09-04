<?php

/**
 * Respresenta un rol de usuario para nuestro sistema. Como ser: Admisnitrador, 
 * Operador, Técnico, etc.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Rol {

    private $_nombre;
    private $_descripcion;

    function __construct($_nombre, $_descripcion) {
        $this->_nombre = $_nombre;
        $this->_descripcion = $_descripcion;
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

}
