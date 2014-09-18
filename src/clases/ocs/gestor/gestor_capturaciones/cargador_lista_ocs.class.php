<?php

/**
 * Description of cargador_listas_ocs
 *
 * @author Diego
 */
class CargadorListaOcs implements CargadorLista {

    /**
     * 
     * @param Array $excluidos Conjunto de ids que serán excluídos del resutlado.
     * @return Array Un array indexado, cuyos elementos son array asociativos 
     * con claves "id" y "lastcome"
     */
    public function cargar_lista($excluidos) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $resultados = $conexion->consultar_simple("SELECT * FROM hardware");
        for ($i = 0; $i < count($resultados); $i++) {
            $id_maquina_ocs = new IdMaquinaOcs($resultados[$i]['ID']);
            $id_maquina_ocs->agregrar_valores_unicidad($resultados[$i]);
            $id_maquina_ocs->generar_id_hash();
            $resultados[$i]['clave_unica'] = $id_maquina_ocs->get_id_hash();
        }
        return $resultados;
    }

}
