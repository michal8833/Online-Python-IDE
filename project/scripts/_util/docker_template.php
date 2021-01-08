<?php

require_once "env_loader.php";

const DOCKERFILE = "../docker/Dockerfile";
const DOCKERFILE_TEMPLATE = DOCKERFILE."_template";

function docker_template() {
    if (!file_exists(ENV_FILE)) {
        print(".env file doesn't exist");
        exit(-1);
    }

    $env = get_env();
    $dockerfileTemplate = file_get_contents(DOCKERFILE_TEMPLATE);
    foreach ($env as $key => $value) {
        $dockerfileTemplate = str_replace('{{'.$key.'}}', $value, $dockerfileTemplate);
    }
    file_put_contents(DOCKERFILE, $dockerfileTemplate);
}

