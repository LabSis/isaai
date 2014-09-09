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
        $resultados = $conexion->consultar_simple("SELECT id, ipaddr, lastcome FROM hardware");
        $lista_resultados_ocs = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $mapa = array();
            //definir todos los datos posbiles que la funcion hash pueda requerir
            $mapa['id'] = $resultados[$i]['ipaddr'];
            $lista_resultados_ocs[GestorCapturaciones::hash($mapa)] = $resultados[$i]['lastcome'];
        }
        return $lista_resultados_ocs;
    }

}
