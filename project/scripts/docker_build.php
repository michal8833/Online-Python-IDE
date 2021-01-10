<?php

require_once "_util/env_loader.php";

$env = get_env();
$dockerfilePath = __DIR__.'/../docker/';

if (!file_exists($dockerfilePath.'Dockerfile')) {
    printf("Dockerfile under path '%s' doesn't exist, run scripts/docker_template.php first\n", $dockerfilePath);
    exit(-1);
}

print shell_exec("docker build -t --rm {$env['DOCKER_CONTAINER_NAME']} $dockerfilePath");

echo "Python interpreter image built successfully\n";

