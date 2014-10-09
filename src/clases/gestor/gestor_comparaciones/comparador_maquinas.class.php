<?php

/**
 * 
 *
 * @author Parisi Germán
 * @version 1.0
 */
class ComparadorMaquinas {

    private $_componentes_cambiados;

    function __construct() {
        $this->_componentes_cambiados = array();
    }

    /**
     * Retorna si estas dos máquinas son iguales o diferentes y en caso que
     * sean diferentes guarda los cambios en componentes_cambiados.
     * @param \Maquina $maquina1
     * @param \Maquina $maquina2
     * @return boolean
     */
    public function verificar_igualdad($maquina1, $maquina2) {
        assert(!is_null($maquina1));
        assert(!is_null($maquina2));

        $iguales = true;

        if (!$maquina1->get_bios()->equals($maquina2->get_bios())) {
            $this->_componentes_cambiados[] = $maquina2->get_bios();
            $iguales = false;
        }
        $iguales &= $this->verificar_cambios($maquina1->get_discos(), $maquina2->get_discos());
        $iguales &= $this->verificar_cambios($maquina1->get_memorias(), $maquina2->get_memorias());
        $iguales &= $this->verificar_cambios($maquina1->get_monitores(), $maquina2->get_monitores());
        $iguales &= $this->verificar_cambios($maquina1->get_perifericos(), $maquina2->get_perifericos());
        $iguales &= $this->verificar_cambios($maquina1->get_placas_red(), $maquina2->get_placas_red());
        $iguales &= $this->verificar_cambios($maquina1->get_placas_sonido(), $maquina2->get_placas_sonido());
        $iguales &= $this->verificar_cambios($maquina1->get_placas_video(), $maquina2->get_placas_video());
        $iguales &= $this->verificar_cambios($maquina1->get_procesadores(), $maquina2->get_procesadores());
        return $iguales;
    }

    private function verificar_cambios($maquina1_componentes, $maquina2_componentes) {
        $igual = true;
        for ($i = 0; $i < count($maquina1_componentes); $i++) {
            //Es necesario agregar también los componentes nuevos!
            //es decir, el caso en que count($maquina1_componentes) > count($maquina2_componentes)
            if (isset($maquina1_componentes[$i]) && isset($maquina2_componentes[$i])) {
                if (!$maquina1_componentes[$i]->equals($maquina2_componentes[$i])) {
                    $this->_componentes_cambiados[] = $maquina1_componentes[$i];
                    $igual = false;
                }
            }
        }
        return $igual;
    }

    public function get_componentes_cambiados() {
        return $this->_componentes_cambiados;
    }

}
