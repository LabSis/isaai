<?php

/**
 * Esta clase representa un computadora con todos sus componentes, como por 
 * ejemplo procesador, bios, perisféricos, entre otros.
 *
 * @author Diego Barrionuevo, Milagros Zea Cardenas, Germán Parisi
 * @version 1.0
 */
class Maquina {

    /**
     *
     * @var String ID hash de la máquina (tal como se guarda en la base de 
     * datos ISAAI)
     */
    private $_id;
    private $_nombre;
    private $_sistema_operativo;
    private $_fecha_alta;
    private $_fecha_cambio;
    private $_fecha_sincronizacion;
    private $_bios;
    private $_discos;
    private $_memorias;
    private $_monitores;
    private $_perifericos;
    private $_placas_red;
    private $_placas_sonido;
    private $_placas_video;
    private $_procesadores;

    function __construct() {
        $this->_id = null;
        $this->_nombre = null;
        $this->_sistema_operativo = null;
        $this->_fecha_alta = null;
        $this->_fecha_cambio = null;
        $this->_fecha_sincronizacion = null;
        $this->_bios = null;
        $this->_discos = array();
        $this->_memorias = array();
        $this->_monitores = array();
        $this->_perifericos = array();
        $this->_placas_red = array();
        $this->_placas_sonido = array();
        $this->_placas_video = array();
        $this->_procesadores = array();
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_sistema_operativo() {
        return $this->_sistema_operativo;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function get_fecha_cambio() {
        return $this->_fecha_cambio;
    }

    public function get_fecha_sincronizacion() {
        return $this->_fecha_sincronizacion;
    }

    public function get_bios() {
        return $this->_bios;
    }

    public function get_discos() {
        return $this->_discos;
    }

    public function get_memorias() {
        return $this->_memorias;
    }

    public function get_monitores() {
        return $this->_monitores;
    }

    public function get_perifericos() {
        return $this->_perifericos;
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

    public function get_procesadores() {
        return $this->_procesadores;
    }

    public function get_procesador($i) {
        return $this->_procesadores[$i];
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_sistema_operativo($_sistema_operativo) {
        $this->_sistema_operativo = $_sistema_operativo;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

    public function set_fecha_cambio($_fecha_cambio) {
        $this->_fecha_cambio = $_fecha_cambio;
    }

    public function set_fecha_sincronizacion($_fecha_sincronizacion) {
        $this->_fecha_sincronizacion = $_fecha_sincronizacion;
    }

    public function set_bios($_bios) {
        $this->_bios = $_bios;
    }

    public function set_discos($_discos) {
        $this->_discos = $_discos;
    }

    public function set_memorias($_memorias) {
        $this->_memorias = $_memorias;
    }

    public function set_monitores($_monitores) {
        $this->_monitores = $_monitores;
    }

    public function set_perifericos($_perifericos) {
        $this->_perifericos = $_perifericos;
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

    public function set_procesadores($_procesadores) {
        $this->_procesadores = $_procesadores;
    }

    public function insertar() {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $conexion->transaccion_comenzar();
        $ok = true;
        $datos_insercion = array(
            'id' => $this->_id,
            'fecha_cambio' => Util::convertir_fecha_a_mysql($this->_fecha_cambio),
            'id_sistema_operativo' => '1',
            'nombre' => $this->_nombre,
            'fecha_alta' => Util::convertir_fecha_a_mysql($this->_fecha_alta),
            'fecha_sincronizacion' => $this->_fecha_sincronizacion
        );
        $ok &= $conexion->insertar('maquinas', $datos_insercion);
        $ok &= BiosIsaai::desmaterializar($this, $this->_bios);
        for ($i = 0; $i < count($this->_discos); $i++) {
            $ok &= DiscoIsaai::desmaterializar($this, $this->_discos[$i]);
        }
        for ($i = 0; $i < count($this->_memorias); $i++) {
            $ok &= MemoriaIsaai::desmaterializar($this, $this->_memorias[$i]);
        }
        for ($i = 0; $i < count($this->_monitores); $i++) {
            $ok &= MonitorIsaai::desmaterializar($this, $this->_monitores[$i]);
        }
        for ($i = 0; $i < count($this->_perifericos); $i++) {
            $ok &= PerisfericoIsaai::desmaterializar($this, $this->_perifericos[$i]);
        }
        for ($i = 0; $i < count($this->_placas_red); $i++) {
            $ok &= PlacaRedIsaai::desmaterializar($this, $this->_placas_red[$i]);
        }
        for ($i = 0; $i < count($this->_placas_sonido); $i++) {
            $ok &= PlacaSonidoIsaai::desmaterializar($this, $this->_placas_sonido[$i]);
        }
        for ($i = 0; $i < count($this->_placas_video); $i++) {
            $ok &= PlacaVideoIsaai::desmaterializar($this, $this->_placas_video[$i]);
        }
        for ($i = 0; $i < count($this->_procesadores); $i++) {
            $ok &= ProcesadorIsaai::desmaterializar($this, $this->_procesadores[$i]);
        }
        if ($ok) {
            $conexion->transaccion_confirmar();
        } else {
            $conexion->transaccion_revertir();
        }
        return $ok;
    }

}
