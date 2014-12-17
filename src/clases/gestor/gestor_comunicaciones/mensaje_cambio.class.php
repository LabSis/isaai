<?php

/* Esta clase repesentará la información, referida a los cambios ocurridos en una computadora
 * con sus roles y tipos de cambios asociados.
 * 
 * @author Milagros Zea Cárdenas 
 * @version 1.0
 */

class MensajeCambio {

    private $_cambio;
    private $_rol_x_tipos_cambio;

    function __construct() {
        $this->_cambio = null;
        $this->_rol_x_tipos_cambio = null;
    }

    public function get_rol_x_tipos_cambio() {
        return $this->_rol_x_tipos_cambio;
    }

    public function set_rol_x_tipos_cambio($_rol_x_tipos_cambio) {
        $this->_rol_x_tipos_cambio = $_rol_x_tipos_cambio;
    }

    public function get_cambio() {
        return $this->_cambio;
    }

    public function set_cambio($_cambio) {
        $this->_cambio = $_cambio;
    }

}
