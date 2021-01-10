<?php

$databaseRunning = shell_exec("if docker ps | grep -q mysql; then printf 'true'; else printf 'false'; fi");
if ($databaseRunning === 'true') {
    print shell_exec("docker stop $(docker ps -q --filter ancestor=mysql/mysql-server:8.0)");
} else {
    echo "MySQL database isn't running\n";
}
