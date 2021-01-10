<?php

require_once "_util/env_loader.php";

$DOCKERFILE = __DIR__.'/../docker/Dockerfile';
$DOCKERFILE_TEMPLATE = $DOCKERFILE.'_template';

$env = get_env();
$dockerfileTemplate = file_get_contents($DOCKERFILE_TEMPLATE);
foreach ($env as $key => $value) {
    $dockerfileTemplate = str_replace('{{'.$key.'}}', $value, $dockerfileTemplate);
}
file_put_contents($DOCKERFILE, $dockerfileTemplate);

