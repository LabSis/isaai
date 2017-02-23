<?php

/**

 * Representa una memoria RAM física de nuestro sistema
 *
 * @author Milagros Zea 
 * @version 1.0 
 */
class Memoria extends Componente {

    private $_capacidad;
    private $_tipo;
    private $_descripcion;
    private $_numero_serial;
    private $_numero_ranura;
    private $_velocidad;
    private $_nombre;

    function __construct() {
        parent::__construct(null);
        $this->_capacidad = null;
        $this->_tipo = null;
        $this->_descripcion = null;
        $this->_numero_serial = null;
        $this->_numero_ranura = null;
        $this->_velocidad = null;
        $this->_nombre = null;
    }

    public function get_capacidad() {
        return $this->_capacidad;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_numero_serial() {
        return $this->_numero_serial;
    }

    public function get_numero_ranura() {
        return $this->_numero_ranura;
    }

    public function get_velocidad() {
        return $this->_velocidad;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_capacidad($_capacidad) {
        $this->_capacidad = $_capacidad;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function set_numero_serial($_numero_serial) {
        $this->_numero_serial = $_numero_serial;
    }

    public function set_numero_ranura($_numero_ranura) {
        $this->_numero_ranura = $_numero_ranura;
    }

    public function set_velocidad($_velocidad) {
        $this->_velocidad = $_velocidad;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= ($this->_capacidad === $componente->get_capacidad());
        $igual &= ($this->_tipo === $componente->get_tipo());
        $igual &= ($this->_descripcion === $componente->get_descripcion());
        //MEJORA: hc me trae con 000000 y isaai guarda con 0, son lo mismo pero no aqui...
        //$igual &= ($this->_numero_serial === $componente->get_numero_serial());
        $igual &= ($this->_velocidad === $componente->get_velocidad());
        $igual &= ($this->_nombre === $componente->get_nombre());
        return $igual;
    }

}
