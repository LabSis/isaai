<?php

/**
 * Description of cargador_lista_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CargadorListaIsaai implements CargadorLista {

    /**
     * 
     * @param String[] $excluidos Condiciones de deben cumplirse para no condierar tales máquinas
     * @return String[] Array con el id, fecha_cambio y de sincronización de las 
     * máquinas en su último estado (es decir, la última vez que se hizo la sincornización)
     */
    public function cargar_lista($excluidos) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT m1.id, m1.fecha_sincronizacion, m1.fecha_cambio FROM maquinas AS m1 WHERE m1.fecha_sincronizacion = "
                . "(SELECT MAX(m2.fecha_sincronizacion) FROM maquinas AS m2 WHERE m2.id = m1.id)";
        // $consulta = "SELECT id, fecha_sincronizacion, fecha_cambio FROM maquinas AS m WHERE fecha_cambio = "
        //. "(SELECT MAX(fecha_cambio) FROM maquinas WHERE id = m.id)";
        $resultados = $conexion->consultar_simple($consulta);
        for ($i = 0; $i < count($resultados); $i++) {
            $id_maquina_isaai = new IdMaquinaIsaai($resultados[$i]['id'], $resultados[$i]['fecha_cambio']);
            $resultados[$i]['clave_unica'] = $id_maquina_isaai->get_id_hash();
        }
        return $resultados;
    }

}
