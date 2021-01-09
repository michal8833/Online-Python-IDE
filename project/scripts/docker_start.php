<?php

require_once "_util/env_loader.php";

$env = get_env();

$dockerRunning = shell_exec("if docker ps | grep -q {$env['DOCKER_CONTAINER_NAME']}; then echo 'true'; else echo 'false'; fi");
if (!$dockerRunning) {
    print shell_exec("docker run -d -p {$env['DOCKER_PORT']}:{$env['DOCKER_PORT']} {$env['DOCKER_CONTAINER_NAME']}");
}
