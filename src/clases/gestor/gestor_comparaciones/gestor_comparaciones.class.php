<?php

/**
 * 
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class GestorComparaciones {

    /**
     * Recibe 3 listas. Una para las máquinas nuevas. Y otras dos para las 
     * máquinas extraídas del OCS y del ISAAI.
     * 
     * Este método asume que las maquinas_ocs y las maquinas_isaai 
     * contienen los elementos a comparar en el mismo orden.
     * 
     * @param array de Maquina $maquinas_ocs
     * @param array de Maquina $maquinas_isaai
     * @param array de Maquina $maquinas_nuevas
     */
    public function obtener_cambios($maquinas_ocs, $maquinas_isaai, $maquinas_nuevas) {
        assert(count($maquinas_ocs) == count($maquinas_isaai));
        $cambios = array();

        foreach ($maquinas_nuevas as $maquina) {
            $cambio = new Cambio();
            $cambio->set_maquina_actual($maquina);
            $cambios[] = $cambio;
        }

        for ($i = 0; $i < count($maquinas_ocs); $i++) {
            $maquina_ocs = $maquinas_ocs[$i];
            $maquina_isaai = $maquinas_isaai[$i];
            $comparador = new ComparadorMaquinas();
            if ($comparador->verificar_igualdad($maquina_ocs, $maquina_isaai) === false) {
                $cambio = new Cambio();
                $cambio->set_maquina_anterior($maquina_isaai);
                $cambio->set_maquina_actual($maquina_ocs);
                $cambio->set_componentes_cambiados($comparador->get_componentes_cambiados());
                $cambios[] = $cambio;
            }
        }
        return $cambios;
    }

}
