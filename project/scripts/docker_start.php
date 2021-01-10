<?php

require_once "_util/env_loader.php";

$env = get_env();

$imageID = shell_exec("docker images -q ${env['DOCKER_CONTAINER_NAME']}");
if ($imageID == '') {
    echo "Python interpreter image doesn't exist, run scripts/docker_build.php first\n";
    exit(1);
}

$dockerRunning = shell_exec("if docker ps | grep -q {$env['DOCKER_CONTAINER_NAME']}; then printf 'true'; else printf 'false'; fi");
if ($dockerRunning === 'false') {
    print shell_exec("docker run --rm -d --network=host --name {$env['DOCKER_CONTAINER_NAME']} {$env['DOCKER_CONTAINER_NAME']}");
    echo "Python interpreter started\n";
} else {
    echo "Python interpreter docker container is already running\n";
}
