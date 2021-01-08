<?php

const ENV_FILE = "../.env";

static $env = [];

function load_env() {
    GLOBAL $env;
    if (count($env) != 0) {
        return $env;
    }
    $lines = explode("\n", file_get_contents(ENV_FILE));
    $env = [];

    foreach ($lines as $line) {
        $prop = explode('=', $line);
        $key = '';
        $value = '';
        if (count($prop) == 2) {
            $key = $prop[0];
            $value = $prop[1];
        } else if (count($prop) == 1) {
            $key = $prop[0];
        } else {
            printf("Incorrect property format %s", $line);
            exit(-2);
        }
        $env[$key] = $value;
    }
    return $env;
}

$env = load_env();

function get_env() {
    GLOBAL $env;
    return $env;
}
