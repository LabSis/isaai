<?php

/**
 *
 * Interfaz que permite materializar (es decir, pasar entidades de base de datos 
 * a objetos) y desmaterializar (es decir, pasar objetdos en entidades de base 
 * de datos) objetos.
 * 
 * @author Diego Barrionuevo
 * @version 1.0
 */
interface ComponenteMaterializable {

    /**
     * Devuelve un Componente dada un IdMaquina
     */
    public static function materializar($id_maquina);
    
    /**
     * Dada una maquina y un componente, devuelve verdadero si logró inertarlo 
     * o falso en caso contrario.
     */
    public static function desmaterializar($maquina, $componene);
}
