<?php

/**
 * Description of cargador_listas_ocs
 *
 * @author Diego
 */
class CargadorListaHc implements CargadorLista {

    /**
     * 
     * @param Array $excluidos Conjunto de ids que serán excluídos del resutlado.
     * @return Array Un array indexado, cuyos elementos son array asociativos 
     * con claves "id" y "lastcome"
     */
    public function cargar_lista($excluidos) {
        $conexion = Conexion::get_instacia(CONEXION_HC);
        $resultados = $conexion->consultar_simple("SELECT * FROM maquinas");
        for ($i = 0; $i < count($resultados); $i++) {
            $id_maquina_hc = new IdMaquinaHc($resultados[$i]['id']);
            $resultados[$i]['clave_unica'] = $id_maquina_hc->get_id_hash();
        }
        return $resultados;
    }

}
