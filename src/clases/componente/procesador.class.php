<?php

/**
 * Representa un procesador en nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Procesador extends Componente {

    private $_tipo;
    private $_velocidad;
    private $_numero;

    function __construct($_id, $_tipo, $_velocidad, $_numero) {
        parent::__construct($_id);
        $this->_tipo = $_tipo;
        $this->_velocidad = $_velocidad;
        $this->_numero = $_numero;
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

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_velocidad($_velocidad) {
        $this->_velocidad = $_velocidad;
    }

    public function set_numero($_numero) {
        $this->_numero = $_numero;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= $this->_tipo === $componente->get_tipo();
        $igual &= $this->_velocidad === $componente->get_velocidad();
        $igual &= $this->_numero === $componente->get_numero();
        return $igual;
    }

}
