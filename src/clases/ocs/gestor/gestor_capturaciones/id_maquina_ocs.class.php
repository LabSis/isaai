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
        $this->_id_maquina_ocs = $id_maquina;
        $this->_condicion_unicidad = $this->generar_condicion();
        $this->_id_hash = $this->generar_id_hash();
    }

    private function get_mapa_valores() {
        $mapa_valores = array();
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        //hago la consulta sobre la tabla hardware
        $resultados = $conexion->consultar_simple("SELECT *  FROM hardware WHERE id = {$this->_id_maquina_ocs}");
        //escogo la primera máquina, ésta debería ser única, siendo que contiene la pk de la tabla hardware
        $registro_maquina_unica = $resultados[0];
        //hago la lectura del archivo config_ocs.ini para setear el mapa de valores
        $lectura_config_ocs_ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/isaai/config/config_ocs.ini', true);
        $conjunto_parametros = $lectura_config_ocs_ini["unicidad"];
        foreach ($conjunto_parametros as $nombre_parametro => $valor_parametro) {
            //verifica que el parámetro esté seteado en On (de manera case insentivie)
            if (strcasecmp($valor_parametro, "On") === 0) {
                $nombre_campo = self::$correspondencias_tabla_ocs[strtoupper($nombre_parametro)];
                $mapa_valores[$nombre_campo] = $registro_maquina_unica[strtoupper($nombre_campo)];
            }
        }
        return $mapa_valores;
    }

    private function generar_condicion() {
        $mapa_valores = $this->get_mapa_valores();
        $condicion = " 1=1 ";
        foreach ($mapa_valores as $campo => $valor) {
            $condicion .= " AND {$campo} = '{$valor}'";
        }
        return $condicion;
    }

    private function generar_id_hash() {
        $mapa_valores = $this->get_mapa_valores();
        $cadena = implode("", $mapa_valores);
        return GeneradorHash::generar_hash($cadena);
    }

    public function get_condicion_unicidad_sql() {
        return $this->_condicion_unicidad;
    }

    public function get_id_hash() {
        return $this->_id_hash;
    }

}
