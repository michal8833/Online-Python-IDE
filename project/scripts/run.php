<?php

require_once "_util/docker_template.php";
require_once "_util/env_loader.php";

$env = get_env();

docker_template();
start_db();

shell_exec("php artisan serve --port {$env['APP_PORT']}");
