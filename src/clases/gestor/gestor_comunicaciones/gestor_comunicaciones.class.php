<?php

/**
 *
 * @author Parisi Germán
 * @version 1.0
 */
class GestorComunicaciones {

    /**
     * Genera una alerta. Usa todos los alertadores pasados como parámetro.
     * 
     * @param array de \Cambio $lista_cambios Es una lista de cambios.
     * @param array de \Alertador Es un alertador.
     */
    public function alertar($lista_cambios, $alertadores) {
        for ($i = 0; $i < count($lista_cambios); $i++) {
            for ($j = 0; $j < count($alertadores); $j++) {
                //array tipo de cambios
                $tipos_cambios = $this->determinar_tipo_cambio($lista_cambios[$i]);
                //deberia agregar por cada tipo de cambio mas de un rol
                $roles_comunicar = array();
                foreach ($tipos_cambios as $tipo_cambio) {
                    $roles_actuales = $this->determinar_roles_a_enviar($tipo_cambio);
                    foreach ($roles_actuales as $rol_actual) {
                        if (!in_array($rol_actual, $roles_comunicar, true)) {
                            $roles_comunicar[] = $rol_actual;
                        }
                    }
                    $alertadores[$j]->alertar($lista_cambios[$i], $roles_comunicar);
                }
            }
        }
    }

    /**
     * Retorna un tipo de cambio a partir de un cambio.
     * @param \Cambio $cambio
     * @return \TipoCambio
     */
    public function determinar_tipo_cambio($cambio) {
        //Suponemos que lo que haces es identificar los compoenntes que cambiaron,
        //en base a eso y a consutlar la tabla tipos_cambios, saber que instancia
        //de tipo de cambio devolver?
        return TipoCambio::determinar_tipo_cambio($cambio);
    }

    /**
     * Retorna una lista de roles a partir de un tipo de cambio.
     * @param \TipoCambio $tipo_cambio
     * @return Array de \Rol
     */
    public function determinar_roles_a_enviar($tipo_cambio) {
        return Rol::determinar_roles_a_enviar($tipo_cambio);
    }

}
