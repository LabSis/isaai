<?php

/**
 * Esta clase representa un períferico, ejemplo teclado, mouse, etc, en nuestro 
 * sistema.
 *
 * @author store
 */
class Perisferico extends Componente {

    private $_nombre;
    private $_fabricante;
    private $_tipo;
    private $_descripcion;
    private $_interfaz;

    function __construct($_nombre, $_fabricante, $_tipo, $_descripcion, $_interfaz) {
        $this->_nombre = $_nombre;
        $this->_fabricante = $_fabricante;
        $this->_tipo = $_tipo;
        $this->_descripcion = $_descripcion;
        $this->_interfaz = $_interfaz;
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

}
