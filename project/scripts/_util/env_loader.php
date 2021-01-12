<?php

static $env = [];

function load_env() {
    GLOBAL $env;
    if (count($env) != 0) {
        return $env;
    }
    $ENV_FILE = dirname(__FILE__).'/../../.env';
    if (!file_exists($ENV_FILE)) {
        echo ".env file doesn't exist, run 'cp .env.example .env'\n";
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
