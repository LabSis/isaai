<?php

/**
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class Servidor {

    private static $yo;
    private $_HOST = "localhost";
    private $_PUERTO = "9000";
    private $_socket;
    private $_clients;

    private function __construct() {
        $this->_clients = array();
        $this->_iniciar();
    }

    private function _iniciar() {
        $this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($this->_socket === false) {
            // Manejo los errores...
            echo socket_strerror(socket_last_error($this->_socket));
        } else {
            socket_bind($this->_socket, 0, $this->_PUERTO);
            socket_listen($this->_socket);
            $this->_clients[] = $this->_socket;
        }
    }

    public static function get_instancia() {
        if (is_null(self::$yo)) {
            self::$yo = new Servidor();
        }
        return self::$yo;
    }

    public function recibir_cliente() {
        for ($i = 0; $i < count($this->_clients); $i++) {
            $nuevo_socket = socket_accept($this->_socket);
            if ($nuevo_socket < 0) {
                echo "Falló";
            } else {
                $this->_clients[] = $nuevo_socket;
                $cabecera = socket_read($nuevo_socket, 1024);
                $this->perform_handshaking($cabecera, $nuevo_socket, $this->_HOST, $this->_PUERTO);
            }
        }
    }

    public function enviar_alertas($alerta) {
        $msg = $this->mask(json_encode(array('msg' => $alerta)));
        foreach ($this->_clients as $s) {
            @socket_write($s, $msg, strlen($msg));
        }
    }

    public function mask($text) {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);

        if ($length <= 125)
            $header = pack('CC', $b1, $length);
        elseif ($length > 125 && $length < 65536)
            $header = pack('CCn', $b1, 126, $length);
        elseif ($length >= 65536)
            $header = pack('CCNN', $b1, 127, $length);
        return $header . $text;
    }

    public function perform_handshaking($receved_header, $client_conn, $host, $port) {
        $headers = array();
        $lines = preg_split("/\r\n/", $receved_header);
        foreach ($lines as $line) {
            $line = chop($line);
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }

        $secKey = $headers['Sec-WebSocket-Key'];
        $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        //hand shaking header
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
                "Upgrade: websocket\r\n" .
                "Connection: Upgrade\r\n" .
                "WebSocket-Origin: $host\r\n" .
                "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n" .
                "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }
}