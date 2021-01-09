<?php

require_once "_util/env_loader.php";

$env = get_env();

$imageID = shell_exec("docker images -q ${env['DOCKER_CONTAINER_NAME']}");
if ($imageID == '') {
    echo "Python interpreter image doesn't exist, run scripts/docker_build.php first\n";
    exit(1);
}

$dockerRunning = shell_exec("if docker ps | grep -q {$env['DOCKER_CONTAINER_NAME']}; then echo 'true'; else echo 'false'; fi");
if (!$dockerRunning) {
    print shell_exec("docker run -d -p {$env['DOCKER_PORT']}:{$env['DOCKER_PORT']} --name {$env['DOCKER_CONTAINER_NAME']} {$env['DOCKER_CONTAINER_NAME']}");
}
