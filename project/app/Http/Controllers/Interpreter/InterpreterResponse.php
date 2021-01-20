<?php


namespace App\Http\Controllers\Interpreter;


class InterpreterResponse {

    private int $code;
    private string $out;
    private string $err;

    private function __construct($code, $out, $err) {
        $this->code = $code;
        $this->out = $out;
        $this->err = $err;
    }

    public static function ok($code, $out, $err) : InterpreterResponse {
        return new InterpreterResponse($code, $out, $err);
    }

    public static function fail($msg) : InterpreterResponse {
        return new InterpreterResponse(0, '', $msg);
    }

    public function getCode() : int {
        return $this->code;
    }

    public function getOutput() : string {
        return $this->out;
    }

    public function getErrors() : string {
        return $this->err;
    }
}
