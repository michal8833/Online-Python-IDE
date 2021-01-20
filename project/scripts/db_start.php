<?php

require_once "_util/env_loader.php";

$env = get_env();

$databaseRunning = shell_exec("if docker ps | grep -q mysql; then printf 'true'; else printf 'false'; fi");
if ($databaseRunning === 'false') {
    print shell_exec("docker run \
--name={$env['DB_CONNECTION']} \
--net=host \
--rm \
--env MYSQL_ROOT_PASSWORD={$env['DB_ROOT_PASSWORD']} \
--env MYSQL_DATABASE={$env['DB_DATABASE']} \
--env MYSQL_USER={$env['DB_USERNAME']} \
--env MYSQL_PASSWORD={$env['DB_PASSWORD']} \
-d mysql/mysql-server:8.0");

    print shell_exec("while ! timeout 1 bash -c \"echo > /dev/tcp/localhost/{$env['DB_PORT']}\" 2> /dev/null; do sleep 1; done; echo \"Done.\";");
    echo "Database up\n";
} else {
    echo "MySQL database is already running\n";
}
