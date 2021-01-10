<?php

require_once "_util/env_loader.php";

$env = get_env();

$artisan = __DIR__.'/../artisan';
$dumpsql = __DIR__.'/../tests_codeception/_data/dump.sql';

print shell_exec("cd .. && \
php $artisan migrate:fresh && \
php $artisan db:seed && \
docker exec mysql mysqldump -u root --password={$env['DB_ROOT_PASSWORD']} test > $dumpsql");

echo "Migration successful\n";
