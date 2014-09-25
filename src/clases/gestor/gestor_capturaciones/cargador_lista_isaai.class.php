<?php

/**
 * Description of cargador_lista_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CargadorListaIsaai implements CargadorLista {

    public function cargar_lista($excluidos) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $resultados = $conexion->consultar_simple("SELECT id, fecha_sincronizacion, fecha_cambio FROM maquinas");
        for ($i = 0; $i < count($resultados); $i++) {
            $id_maquina_isaai = new IdMaquinaIsaai($resultados[$i]['id'], $resultados[$i]['fecha_sincronizacion']);
            $resultados[$i]['clave_unica'] = $id_maquina_isaai->get_id_hash();
        }
        return $resultados;
    }

}
