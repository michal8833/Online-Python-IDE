<?php

namespace App\Http\Controllers\Interpreter;

class TCPClient {

    private string $url;

    public static function create($host, $port) {
        return new TCPClient($host, $port);
    }

    private function __construct($host, $port) {
        $this->url = "tcp://$host:$port";
    }

    public function send(string $byteBuffer) : string {
        $fp = stream_socket_client($this->url, $errno, $errstr, 30);
        if (!$fp || !is_resource($fp)) {
            return false;
        } else {
            fwrite($fp, $byteBuffer);
            $response = stream_get_contents($fp);
            fclose($fp);
            return $response;
        }
    }
}
