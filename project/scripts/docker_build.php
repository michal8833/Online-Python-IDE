<?php

require_once "_util/env_loader.php";

$env = get_env();
$dockerfilePath = __DIR__.'/../docker/';

if (!file_exists($dockerfilePath.'Dockerfile')) {
    printf("Dockerfile under path '%s' doesn't exist\n", $dockerfilePath);
    exit(-1);
}

print shell_exec("docker build --rm -t {$env['DOCKER_CONTAINER_NAME']} $dockerfilePath");

echo "Python interpreter image built successfully\n";

