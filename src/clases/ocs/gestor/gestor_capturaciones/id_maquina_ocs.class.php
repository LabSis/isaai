<?php

/**
 * Encapsula la logica de recuperación de una máquina única de la base de datos 
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
    }

    private function generar_condicion() {
        $campos_considerados = array();
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $resultados = $conexion->consultar_simple("SELECT *  FROM hardware WHERE id = {$this->_id_maquina_ocs}");
        $registro_maquina_unica = $resultados[0];
        //lectura del archivo config_ocs.ini
        $lectura_config_ocs_ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/isaai/config/config_ocs.ini', true);
        $conjunto_parametros = $lectura_config_ocs_ini["unicidad"];
        foreach ($conjunto_parametros as $nombre_parametro => $valor_parametro) {
            if (strcasecmp($valor_parametro, "On") === 0) {
                $nombre_campo = self::$correspondencias_tabla_ocs[strtoupper($nombre_parametro)];
                $campos_considerados[$nombre_campo] = $registro_maquina_unica[strtoupper($nombre_campo)];
            }
        }
        $condicion = " 1=1 ";
        foreach ($campos_considerados as $campo => $valor) {
            $condicion .= " AND {$campo} = '{$valor}'";
        }
        return $condicion;
    }
    
    private function generar_id_hash(){
        return GeneradorHash::generar_hash("Falta implementar!");
    }

    public function get_condicion_unicidad_sql() {
        return $this->_condicion_unicidad;
    }

    public function get_id_hash() {
        return $this->_id_hash;
    }

}
