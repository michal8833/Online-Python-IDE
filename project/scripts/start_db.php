<?php

require_once "_util/env_loader.php";

function start_db() {
    $env = get_env();

    shell_exec("docker run
--name={$env['DB_CONNECTION']}
--net=host
--rm
--env MYSQL_ROOT_PASSWORD={$env['DB_ROOT_PASSWORD']}
--env MYSQL_DATABASE={$env['DB_DATABASE']}
--env MYSQL_USER={$env['DB_USERNAME']}
--env MYSQL_PASSWORD={$env['DB_PASSWORD']}
-d mysql/mysql-server:8.0");

    shell_exec("while ! timeout 1 bash -c \"echo > /dev/tcp/localhost/{$env['DB_PORT']}\" 2> /dev/null; do sleep 1; done; echo \"Done.\";");
}
