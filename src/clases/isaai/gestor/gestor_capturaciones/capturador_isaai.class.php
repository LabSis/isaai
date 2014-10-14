<?php

/**
 *
 * @author Diego Barrionevo
 * @version 1.0
 */
class CapturadorIsaai implements Capturador {

    public static function obtener_maquina($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT * FROM maquinas AS maquina WHERE {$id_maquina->get_condicion_unicidad_sql()}";
        $resultados = $conexion->consultar_simple($consulta);

        $maquina = new Maquina();
        $maquina->set_id($id_maquina->get_id_hash());
        $maquina->set_nombre($resultados[0]["nombre"]);
        $maquina->set_fecha_alta($resultados[0]["fecha_alta"]);
        $maquina->set_fecha_cambio($resultados[0]["fecha_cambio"]);
        $maquina->set_fecha_sincronizacion($resultados[0]["fecha_sincronizacion"]);

        $sistema_operativo = SistemaOperativo::materializar($id_maquina);
        $maquina->set_sistema_operativo($sistema_operativo);

        $bios = BiosIsaai::materializar($id_maquina);
        $maquina->set_bios($bios);

        $discos = DiscoIsaai::materializar($id_maquina);
        $maquina->set_discos($discos);

        $memorias = MemoriaIsaai::materializar($id_maquina);
        $maquina->set_memorias($memorias);

        $perifericos = PerifericoIsaai::materializar($id_maquina);
        $maquina->set_perifericos($perifericos);

        $placas_red = PlacaRedIsaai::materializar($id_maquina);
        $maquina->set_placas_red($placas_red);

        $placas_sonido = PlacaSonidoIsaai::materializar($id_maquina);
        $maquina->set_placas_sonido($placas_sonido);

        $placas_video = PlacaVideoIsaai::materializar($id_maquina);
        $maquina->set_placas_video($placas_video);

        $procesadores = ProcesadorIsaai::materializar($id_maquina);
        $maquina->set_procesadores($procesadores);

        return $maquina;
    }

}
