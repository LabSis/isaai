<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public function obtener_maquina($id_maquina_ocs) {
        $maquina = new Maquina(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $id_maquina_ocs->cargar_valores_unicidad();
        $id_maquina_ocs->generar_condicion_unicidad_sql();
        $maquina->set_procesadores(ProcesadorOcs::materializar($id_maquina_ocs));
        //maquina->set_bios(BiosOcs::materializar($id_maquina_ocs));
        return $maquina;
    }

}
