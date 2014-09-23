<?php

/**
 * Encapsula la lógica de recuperación de una máquina única de la base de datos 
 * del OCS.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class IdMaquinaOcs extends IdMaquina {

    /**
     *
     * @var String Representa el valor de la columna id de la tabla hardware del ocs.
     */
    private $_id_maquina_ocs;
    private $_condicion_unicidad;
    private $_id_hash;
    private $_mapa_valores; //sus claves son los campos en la tabla hardware, y 
    //sus valores son los correspondientes al registro del id a ser consultado
    public static $_parametros_considerados;
    public static $correspondencias_tabla_ocs = array(
        'VERSION_SO' => 'osversion',
        'NOMBRE_SO' => 'osname',
        'NOMBRE_MAQUINA' => 'name',
        'DOMINIO_USUARIO' => 'userdomain',
        'UUID' => 'uuid',
        'DIRECCION_IP' => 'ipaddr',
        'ID_USUARIO' => 'userid',
        'VERSION_AGENTE_OCS' => 'useragent'
    );

    function __construct($id_maquina) {
        if (self::$_parametros_considerados === null) {
            self::cargar_parametros_considerados();
        }
        $this->_id_maquina_ocs = $id_maquina;
    }

    private static function cargar_parametros_considerados() {
        self::$_parametros_considerados = array();
        $lectura_config_ocs_ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/isaai/config/config_ocs.ini', true);
        $conjunto_parametros = $lectura_config_ocs_ini["unicidad"];
        foreach ($conjunto_parametros as $nombre_parametro => $valor_parametro) {
            //verifica que el parámetro esté seteado en On (de manera case insentivie)
            if (strcasecmp($valor_parametro, "On") === 0) {
                self::$_parametros_considerados[] = strtoupper($nombre_parametro);
            }
        }
    }

    public function cargar_valores_unicidad() {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        //hago la consulta sobre la tabla hardware
        $resultados = $conexion->consultar_simple("SELECT * FROM hardware WHERE ID = {$this->_id_maquina_ocs}");
        //escogo la primera máquina, ésta debería ser única, siendo que contiene la pk de la tabla hardware
        $registro_maquina_unica = $resultados[0];
        $this->agregrar_valores_unicidad($registro_maquina_unica);
    }

    public function agregrar_valores_unicidad($valores_consulta) {
        $mapa_valores = array();
        $registro_maquina_unica = $valores_consulta;
        foreach (self::$_parametros_considerados as $parametro) {
            $nombre_campo_ocs = self::$correspondencias_tabla_ocs[strtoupper($parametro)];
            $mapa_valores[$nombre_campo_ocs] = $registro_maquina_unica[strtoupper($nombre_campo_ocs)];
        }
        $this->_mapa_valores = $mapa_valores;
    }

    public function generar_condicion_unicidad_sql() {
        $mapa_valores = $this->_mapa_valores;
        $condicion = " 1=1 ";
        foreach ($mapa_valores as $campo => $valor) {
            $condicion .= " AND hardware.{$campo} = '{$valor}'";
        }
        $this->_condicion_unicidad = $condicion;
    }

    public function generar_id_hash() {
        //cualquier problema del orden de los valores para cargar el hash es 
        //resolvería aquí
        $mapa_valores = $this->_mapa_valores;
        $cadena = implode("", $mapa_valores);
        $this->_id_hash = GeneradorHash::generar_hash($cadena);
    }

    public function get_condicion_unicidad_sql() {
        if ($this->_condicion_unicidad === null) {
            $this->generar_condicion_unicidad_sql();
        }
        return $this->_condicion_unicidad;
    }

    public function get_id_hash() {
        if ($this->_id_hash === null) {
            $this->generar_id_hash();
        }
        return $this->_id_hash;
    }

}
