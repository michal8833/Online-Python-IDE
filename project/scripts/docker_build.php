<?php

require_once "_util/env_loader.php";

$env = get_env();
$dockerfilePath = dirname(__FILE__).'/../docker/';

if (!file_exists($dockerfilePath)) {
    printf("Dockerfile under path '%s' doesn't exist", $dockerfilePath);
    exit(-1);
}

print shell_exec("docker build -t {$env['DOCKER_CONTAINER_NAME']} $dockerfilePath");

