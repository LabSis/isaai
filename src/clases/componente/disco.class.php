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

    function __construct($_nombre, $_fabricante, $_modelo, $_descripcion, $_tipo, $_tamanio, $_numero_serial, $_firmware) {
        $this->_nombre = $_nombre;
        $this->_fabricante = $_fabricante;
        $this->_modelo = $_modelo;
        $this->_descripcion = $_descripcion;
        $this->_tipo = $_tipo;
        $this->_tamanio = $_tamanio;
        $this->_numero_serial = $_numero_serial;
        $this->_firmware = $_firmware;
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

}
