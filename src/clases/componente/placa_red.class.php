<?php

/**
 * Representa una placa de red en nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class PlacaRed extends Componente {

    private $_direccion_ip;
    private $_direccion_mac;
    private $_direccion_red;
    private $_direccion_dns;
    private $_mascara;
    private $_gateway;
    private $_descripcion;
    private $_tipo;
    private $_velocidad;

    function __construct($_id, $_direccion_ip, $_direccion_mac, $_direccion_red, $_direccion_dns, $_mascara, $_gateway, $_descripcion, $_tipo, $_velocidad) {
        parent::__construct($_id);
        $this->_direccion_ip = $_direccion_ip;
        $this->_direccion_mac = $_direccion_mac;
        $this->_direccion_red = $_direccion_red;
        $this->_direccion_dns = $_direccion_dns;
        $this->_mascara = $_mascara;
        $this->_gateway = $_gateway;
        $this->_descripcion = $_descripcion;
        $this->_tipo = $_tipo;
        $this->_velocidad = $_velocidad;
    }

    public function get_direccion_ip() {
        return $this->_direccion_ip;
    }

    public function get_direccion_mac() {
        return $this->_direccion_mac;
    }

    public function get_direccion_red() {
        return $this->_direccion_red;
    }

    public function get_direccion_dns() {
        return $this->_direccion_dns;
    }

    public function get_mascara() {
        return $this->_mascara;
    }

    public function get_gateway() {
        return $this->_gateway;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_velocidad() {
        return $this->_velocidad;
    }

    public function set_direccion_ip($_direccion_ip) {
        $this->_direccion_ip = $_direccion_ip;
    }

    public function set_direccion_mac($_direccion_mac) {
        $this->_direccion_mac = $_direccion_mac;
    }

    public function set_direccion_red($_direccion_red) {
        $this->_direccion_red = $_direccion_red;
    }

    public function set_direccion_dns($_direccion_dns) {
        $this->_direccion_dns = $_direccion_dns;
    }

    public function set_mascara($_mascara) {
        $this->_mascara = $_mascara;
    }

    public function set_gateway($_gateway) {
        $this->_gateway = $_gateway;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    public function set_velocidad($_velocidad) {
        $this->_velocidad = $_velocidad;
    }

    public function equals($componente) {
        $igual = true;
        $igual &= $this->_descripcion === $componente->get_descripcion();
        $igual &= $this->_direccion_dns === $componente->get_direccion_dns();
        $igual &= $this->_direccion_ip === $componente->get_direccion_ip();
        $igual &= $this->_direccion_mac === $componente->get_direccion_mac();
        $igual &= $this->_direccion_red === $componente->get_direccion_red();
        $igual &= $this->_gateway === $componente->get_gateway();
        $igual &= $this->_mascara === $componente->get_mascara();
        $igual &= $this->_tipo === $componente->get_tipo();
        $igual &= $this->_velocidad === $componente->get_velocidad();
    }

}
