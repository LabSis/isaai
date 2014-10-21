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
        for($i = 0; $i < count($lista_cambios); $i++){
            for($j = 0; $j < count($alertadores); $j++){
                $tipo_cambio = $this->determinar_tipo_cambio($lista_cambios[$i]);
                $roles = $this->determinar_roles_a_enviar($tipo_cambio);
                $alertadores[$j]->alertar($lista_cambios[$i], $roles);
            }
        }
    }
    /**
     * Retorna un tipo de cambio a partir de un cambio.
     * @param \Cambio $cambio
     * @return \TipoCambio
     */
    public function determinar_tipo_cambio($cambio){
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
    public function determinar_roles_a_enviar($tipo_cambio){
        return Rol::determinar_roles_a_enviar($tipo_cambio);
    }
}