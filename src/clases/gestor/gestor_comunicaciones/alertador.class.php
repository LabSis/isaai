<?php

/**
 * Cada alertador debe implementar esta interfaz.
 * 
 * @author Parisi Germán
 * @version 1.0
 */
interface Alertador {
    /**
     * Este método debe generar la alerta por el medio correspondiente.
     * @param \Cambio $cambio Es el cambio que debe alertar.
     * @param \Rol Son los roles a los cuales se va a alertar.
     */
    public function alertar($cambio, $roles);
}