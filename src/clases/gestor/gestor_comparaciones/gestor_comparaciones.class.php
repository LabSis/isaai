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
    public function obtener_cambios($maquinas_actuales, $maquinas_anteriores, $maquinas_nuevas) {
        assert(count($maquinas_actuales) == count($maquinas_anteriores));

        $fecha_actual = Util::get_fecha_y_hora_actual_mysql(); //fecha actual
        $fecha_cambio = $fecha_actual;
        $fecha_sincronizacion = $fecha_actual;

        $cambios = array();

        foreach ($maquinas_nuevas as $maquina) {
            $cambio = new Cambio();
            $maquina->set_fecha_alta($fecha_actual);
            $maquina->set_fecha_cambio($fecha_actual);
            $maquina->set_fecha_sincronizacion($fecha_actual);
            $cambio->set_maquina_actual($maquina);
            $cambios[] = $cambio;
        }

        for ($i = 0; $i < count($maquinas_actuales); $i++) {
            $maquina_actual = $maquinas_actuales[$i];
            $maquina_anterior = $maquinas_anteriores[$i];
            $comparador = new ComparadorMaquinas();
            if ($comparador->verificar_igualdad($maquina_actual, $maquina_anterior) === false) {
                $cambio = new Cambio();
                $cambio->set_maquina_anterior($maquina_anterior);
                $cambio->set_maquina_actual($maquina_actual);
                $cambio->set_componentes_cambiados($comparador->get_componentes_cambiados());
                $cambios[] = $cambio;
                //Actualizo las maquinas con los componentes actuales en la base de datos isaai
                $maquina_actual->set_fecha_cambio($fecha_cambio);
                $maquina_actual->set_fecha_sincronizacion($fecha_sincronizacion);
                $maquina_actual->actualizar_cambios_componentes($comparador->get_componentes_cambiados());
            }
            //Por más de que no haya cambiado la máquina, es necesario actualizar 
            //la fecha de sincornización de las máquinas en isaai
            $maquina_actual->actualizar_fecha_sincronizacion();
        }
        return $cambios;
    }

}
