<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generador_hash
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
abstract class GeneradorHash {

    /**
     * Retorna una cadena con 128 caracteres, después de aplicar el algoritmo 
     * de hashing MD5.
     * @param String Cadena original de logintud cualquiera.
     * @return String Retorna un cadena con 128 caracteres.
     */
    public static function generar_hash($cadena) {
        return md5($cadena);
    }

}
