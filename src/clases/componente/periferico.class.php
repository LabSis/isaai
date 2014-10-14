<?php

/**
 * Esta clase representa un períferico, ejemplo teclado, mouse, etc, en nuestro 
 * sistema.
 *
 * @author Milagros Zea Cárdenas
 * @version 1.0
 */
class Periferico extends Componente {

    private $_nombre;
    private $_fabricante;
    private $_tipo;
    private $_descripcion;
    private $_interfaz;

    function __construct() {
        parent::__construct(null);
        $this->_nombre = null;
        $this->_fabricante = null;
        $this->_tipo = null;
        $this->_descripcion = null;
        $this->_interfaz = null;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_fabricante() {
        return $this->_fabricante;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_interfaz() {
        return $this->_interfaz;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_fabricante($_fabricante) {
        $this->_fabricante = $_fabricante;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function set_interfaz($_interfaz) {
        $this->_interfaz = $_interfaz;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= $this->_descripcion == $componente->get_descripcion();
        $igual &= $this->_fabricante == $componente->get_fabricante();
        $igual &= $this->_interfaz == $componente->get_interfaz();
        $igual &= $this->_nombre == $componente->get_nombre();
        $igual &= $this->_tipo == $componente->get_tipo();
        return $igual;
    }

}
