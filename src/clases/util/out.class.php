<?php

/**
 * Permite hacer la salida por consola de una forma ordenada y clara.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Out {

    public static function println($line) {
        echo "<br/>" . $line . PHP_EOL;
    }

    public static function print_array($array) {
        Out::println("Cantidad de elementos: " .count($array));
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

}
