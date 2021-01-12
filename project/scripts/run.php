<?php

require_once "_util/env_loader.php";
$env = get_env();

require_once "docker_start.php";
require_once "db_start.php";

$artisan = __DIR__.'/../artisan';
$logPath = __DIR__.'/../logs/server.log';
$logging = "2>&1 2>$logPath >$logPath";

print shell_exec("php $artisan serve --port {$env['APP_PORT']} $logging");

echo "App server running on: {$env['APP_URL']}:{$env['APP_PORT']}\n";
