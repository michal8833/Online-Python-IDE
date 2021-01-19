<?php

require_once "_util/env_loader.php";
$env = get_env();

require_once "db_start.php";

$artisan = __DIR__.'/../artisan';
$logPath = __DIR__.'/../logs/server.log';
$logging = "2>&1 2>>$logPath >>$logPath";

echo "App server running on: {$env['APP_URL']}:{$env['APP_PORT']}\n";

print shell_exec("php $artisan serve --port {$env['APP_PORT']} $logging");

