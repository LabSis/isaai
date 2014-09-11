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
        return $conexion->consultar_simple("CALL listar()");
    }

}
