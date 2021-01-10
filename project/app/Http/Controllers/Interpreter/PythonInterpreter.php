<?php


namespace App\Http\Controllers\Interpreter;

class PythonInterpreter {

    private TCPClient $tcpClient;

    public function __construct() {
        $this->tcpClient = TCPClient::create(env('APP_HOST'), env('DOCKER_PORT'));
    }

    public function interpret(array $files) {
        $packet = [];
        foreach ($files as $file) {
            $singleFile = [
                "name" => $file['name'],
                "content" => $file['content']
            ];
            $packet[] = $singleFile;
        }
        $packet = json_encode($packet);
        return $this->tcpClient->send($packet);
    }
}
