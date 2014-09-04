<?php

/**
 * Description of procesador
 *
 * @author Diego Barrionuevo
 */
class Procesador implements Componente {

    private $_id;
    private $_tipo;
    private $_velocidad;
    private $_numero;

    function __construct($_id, $_tipo, $_velocidad, $_numero) {
        $this->_id = $_id;
        $this->_tipo = $_tipo;
        $this->_velocidad = $_velocidad;
        $this->_numero = $_numero;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_velocidad() {
        return $this->_velocidad;
    }

    public function get_numero() {
        return $this->_numero;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_velocidad($_velocidad) {
        $this->_velocidad = $_velocidad;
    }

    public function set_numero($_numero) {
        $this->_numero = $_numero;
    }

}
