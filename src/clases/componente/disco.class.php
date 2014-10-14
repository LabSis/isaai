<?php

/**
 * * Representa un procesador en nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Disco extends Componente {

    private $_nombre;
    private $_fabricante;
    private $_modelo;
    private $_descripcion;
    private $_tipo;
    private $_tamanio;
    private $_numero_serial;
    private $_firmware;

    function __construct() {
        parent::__construct(null);
        $this->_nombre = null;
        $this->_fabricante = null;
        $this->_modelo = null;
        $this->_descripcion = null;
        $this->_tipo = null;
        $this->_tamanio = null;
        $this->_numero_serial = null;
        $this->_firmware = null;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_fabricante() {
        return $this->_fabricante;
    }

    public function get_modelo() {
        return $this->_modelo;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_tamanio() {
        return $this->_tamanio;
    }

    public function get_numero_serial() {
        return $this->_numero_serial;
    }

    public function get_firmware() {
        return $this->_firmware;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_fabricante($_fabricante) {
        $this->_fabricante = $_fabricante;
    }

    public function set_modelo($_modelo) {
        $this->_modelo = $_modelo;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_tamanio($_tamanio) {
        $this->_tamanio = $_tamanio;
    }

    public function set_numero_serial($_numero_serial) {
        $this->_numero_serial = $_numero_serial;
    }

    public function set_firmware($_firmware) {
        $this->_firmware = $_firmware;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= $this->_descripcion == $componente->get_descripcion();
        $igual &= $this->_fabricante == $componente->get_fabricante();
        $igual &= $this->_firmware == $componente->get_firmware();
        $igual &= $this->_modelo == $componente->get_modelo();
        $igual &= $this->_nombre == $componente->get_nombre();
        $igual &= $this->_numero_serial == $componente->get_numero_serial();
        $igual &= $this->_tamanio == $componente->get_tamanio();
        $igual &= $this->_tipo == $componente->get_tipo();
        return $igual;
    }

}
