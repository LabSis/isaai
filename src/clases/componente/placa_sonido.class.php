<?php

/**
 * Representa una placa de sonido en nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class placa_sonido {

    private $_nombre;
    private $_fabricante;

    function __construct($_nombre, $_fabricante) {
        $this->_nombre = $_nombre;
        $this->_fabricante = $_fabricante;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_fabricante() {
        return $this->_fabricante;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_fabricante($_fabricante) {
        $this->_fabricante = $_fabricante;
    }

}
