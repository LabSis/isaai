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

    function __construct() {
        parent::__construct(null);
        $this->_tipo = null;
        $this->_velocidad = null;
        $this->_numero = null;
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
    
    public function to_string(){
        $salida = "Tipo: {$this->_tipo}";
        $salida .= ", Velocidad: {$this->_velocidad}";
        $salida .= ", Nucleos: {$this->_numero}";
        return $salida;
    }

}
