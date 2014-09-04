<?php

/**
 * Representa un Monitor en nuestro sistema
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Monitor extends Componente {

    private $_nombre;
    private $_modelo;
    private $_resolucion;

    function __construct($_nombre, $_modelo, $_resolucion) {
        $this->_nombre = $_nombre;
        $this->_modelo = $_modelo;
        $this->_resolucion = $_resolucion;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_modelo() {
        return $this->_modelo;
    }

    public function get_resolucion() {
        return $this->_resolucion;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_modelo($_modelo) {
        $this->_modelo = $_modelo;
    }

    public function set_resolucion($_resolucion) {
        $this->_resolucion = $_resolucion;
    }

}