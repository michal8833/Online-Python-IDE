<?php

require_once "_util/env_loader.php";
$env = get_env();

# TODO: finish docker configuration
# require_once "docker_start.php";
require_once "db_start.php";

$artisan = dirname(__FILE__).'/../artisan';
$logPath = dirname(__FILE__).'/../logs/server.log';
$logging = "2>&1 2>$logPath >$logPath";

print shell_exec("php $artisan serve --port {$env['APP_PORT']} $logging");
