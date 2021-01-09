<?php

static $env = [];

function load_env() {
    GLOBAL $env;
    if (count($env) != 0) {
        return $env;
    }
    $ENV_FILE = dirname(__FILE__).'/../../.env';
    if (!file_exists($ENV_FILE)) {
        print(".env file doesn't exist");
        exit(-1);
    }
    $lines = explode("\n", file_get_contents($ENV_FILE));
    $lines = array_filter($lines, function($item) { return $item != ''; });
    $env = [];

    foreach ($lines as $line) {
        $key = strtok($line, '=');
        $value = strtok('=');
        $env[$key] = $value;
    }
    return $env;
}

$env = load_env();

function get_env() {
    GLOBAL $env;
    return $env;
}
