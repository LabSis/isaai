<?php

/**
 * Esta clase representa un computadora con todos sus componentes, como por 
 * ejemplo procesador, bios, perisféricos, entre otros.
 *
 * @author Diego Barrionuevo, Milagros Zea Cardenas
 * @version 1.0
 */
class Maquina {

    private $_id;
    private $_fecha_alta;
    //private $_fecha_sincronizacion;
    private $_fecha_cambio;
    private $_nombre_maquina;
    private $_fecha_ultimo_contacto;
    private $_procesadores;
    private $_bios;
    private $_placas_red;
    private $_placas_sonido;
    private $_placas_video;
    private $_memorias;
    private $_perisfericos;
    private $_discos;
    private $_monitores;
    private $_sistema_operativo;

    function __construct() {
        $this->_id = null;
        $this->_fecha_cambio = null;
        $this->_fecha_alta = null;
        $this->_nombre_maquina = null;
        $this->_fecha_ultimo_contacto = null;
        $this->_procesadores = null;
        $this->_bios = null;
        $this->_placas_red = null;
        $this->_placas_sonido = null;
        $this->_placas_video = null;
        $this->_memorias = null;
        $this->_perisfericos = null;
        $this->_discos = null;
        $this->_monitores = null;
        $this->_sistema_operativo = null;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function get_nombre_maquina() {
        return $this->_nombre_maquina;
    }

    public function get_fecha_ultimo_contacto() {
        return $this->_fecha_ultimo_contacto;
    }

    public function get_procesadores() {
        return $this->_procesadores;
    }

    public function get_bios() {
        return $this->_bios;
    }

    public function get_placas_red() {
        return $this->_placas_red;
    }

    public function get_placas_sonido() {
        return $this->_placas_sonido;
    }

    public function get_placas_video() {
        return $this->_placas_video;
    }

    public function get_memorias() {
        return $this->_memorias;
    }

    public function get_perisfericos() {
        return $this->_perisfericos;
    }

    public function get_discos() {
        return $this->_discos;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

    public function set_nombre_maquina($_nombre_maquina) {
        $this->_nombre_maquina = $_nombre_maquina;
    }

    public function set_fecha_ultimo_contacto($_fecha_ultimo_contacto) {
        $this->_fecha_ultimo_contacto = $_fecha_ultimo_contacto;
    }

    public function set_procesadores($_procesadores) {
        $this->_procesadores = $_procesadores;
    }

    public function set_bios($_bios) {
        $this->_bios = $_bios;
    }

    public function set_placas_red($_placas_red) {
        $this->_placas_red = $_placas_red;
    }

    public function set_placas_sonido($_placas_sonido) {
        $this->_placas_sonido = $_placas_sonido;
    }

    public function set_placas_video($_placas_video) {
        $this->_placas_video = $_placas_video;
    }

    public function set_memorias($_memorias) {
        $this->_memorias = $_memorias;
    }

    public function set_perisfericos($_perisfericos) {
        $this->_perisfericos = $_perisfericos;
    }

    public function set_discos($_discos) {
        $this->_discos = $_discos;
    }

    public function get_monitores() {
        return $this->_monitores;
    }

    public function set_monitores($_monitores) {
        $this->_monitores = $_monitores;
    }

    public function get_sistema_operativo() {
        return $this->_sistema_operativo;
    }

    public function set_sistema_operativo($_sistema_operativo) {
        $this->_sistema_operativo = $_sistema_operativo;
    }

    public function get_fecha_cambio() {
        return $this->_fecha_cambio;
    }

    public function set_fecha_cambio($_fecha_cambio) {
        $this->_fecha_cambio = $_fecha_cambio;
    }

    public function insertar() {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $conexion->transaccion_comenzar();
        $ok = true;
        $this->_fecha_cambio = '2012-10-12';
        $datos_insercion = array(
            'id' => $this->_id,
            'fecha_cambio' => $this->_fecha_cambio,
            'id_sistema_operativo' => '1',
            'nombre_maquina' => 'hardcodeando...',
            'fecha_alta' => '2014-06-10',
            'fecha_ultimo_contacto' => '2013-10-10'
        );
        $ok &= $conexion->insertar('maquinas', $datos_insercion);
        $ok &= ProcesadorIsaai::desmaterializar($this, $this->_procesadores);
        if ($ok) {
            $conexion->transaccion_confirmar();
        } else {
            print_r($conexion->get_error());
            $conexion->transaccion_revertir();
        }
        return $ok;
    }

}
