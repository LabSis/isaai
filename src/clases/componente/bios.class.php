<?php

/**
 * Esta clase representa a una bios en un computadora real.
 *
 * @author Milagros Zea Cárdenas
 * @version 1.0
 */
class Bios extends Componente {

    private $_nombre;
    private $_fabricante;
    private $_modelo;
    private $_asset_tag;
    private $_version;
    private $_numero_serial;

    function __construct() {
        parent::__construct(null);
        $this->_nombre = null;
        $this->_fabricante = null;
        $this->_modelo = null;
        $this->_asset_tag = null;
        $this->_version = null;
        $this->_numero_serial = null;
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

    public function get_asset_tag() {
        return $this->_asset_tag;
    }

    public function get_version() {
        return $this->_version;
    }

    public function get_numero_serial() {
        return $this->_numero_serial;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_fabricante($_fabricante) {
        $this->_fabricante = $_fabricante;
    }

    public function set_modelo($modelo) {
        $this->_modelo = $modelo;
    }

    public function set_asset_tag($_asset_tag) {
        $this->_asset_tag = $_asset_tag;
    }

    public function set_version($_version) {
        $this->_version = $_version;
    }

    public function set_numero_serial($_numero_serial) {
        $this->_numero_serial = $_numero_serial;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= $this->_asset_tag == $componente->get_asset_tag();
        $igual &= $this->_fabricante == $componente->get_fabricante();
        $igual &= $this->_nombre == $componente->get_nombre();
        $igual &= $this->_numero_serial == $componente->get_numero_serial();
        $igual &= $this->_version == $componente->get_version();
        return $igual;
    }

}
