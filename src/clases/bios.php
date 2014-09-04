<?php

/**
 * Esta clase representa a una bios en un computadora real.
 *
 * @author Milagros Zea Cárdenas
 */
class Bios extends Componente {

    private $_nombre;
    private $_fabricante;
    private $modelo;
    private $_asset_tag;
    private $_version;
    private $_numero_serial;

    function __construct($_nombre, $_fabricante, $modelo, $_asset_tag, $_version, $_numero_serial) {
        $this->_nombre = $_nombre;
        $this->_fabricante = $_fabricante;
        $this->modelo = $modelo;
        $this->_asset_tag = $_asset_tag;
        $this->_version = $_version;
        $this->_numero_serial = $_numero_serial;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_fabricante() {
        return $this->_fabricante;
    }

    public function getModelo() {
        return $this->modelo;
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

    public function setModelo($modelo) {
        $this->modelo = $modelo;
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

}
