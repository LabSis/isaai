<?php

/**
 * Representa un usuario de nuestro sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Usuario {

    private $_nombre_usuario;
    private $_clave_usuario;
    private $_rol;
    private $_nombre;
    private $_apellido;
    private $_email;
    private $_telefono;
    private $_direccion;
    private $_fecha_alta;

    function __construct($_nombre_usuario, $_clave_usuario, $_rol, $_nombre, $_apellido, $_email, $_telefono, $_direccion, $_fecha_alta) {
        $this->_nombre_usuario = $_nombre_usuario;
        $this->_clave_usuario = $_clave_usuario;
        $this->_rol = $_rol;
        $this->_nombre = $_nombre;
        $this->_apellido = $_apellido;
        $this->_email = $_email;
        $this->_telefono = $_telefono;
        $this->_direccion = $_direccion;
        $this->_fecha_alta = $_fecha_alta;
    }

    public function get_nombre_usuario() {
        return $this->_nombre_usuario;
    }

    public function get_clave_usuario() {
        return $this->_clave_usuario;
    }

    public function get_rol() {
        return $this->_rol;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_apellido() {
        return $this->_apellido;
    }

    public function get_email() {
        return $this->_email;
    }

    public function get_telefono() {
        return $this->_telefono;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function set_nombre_usuario($_nombre_usuario) {
        $this->_nombre_usuario = $_nombre_usuario;
    }

    public function set_clave_usuario($_clave_usuario) {
        $this->_clave_usuario = $_clave_usuario;
    }

    public function set_rol($_rol) {
        $this->_rol = $_rol;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_apellido($_apellido) {
        $this->_apellido = $_apellido;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

}
