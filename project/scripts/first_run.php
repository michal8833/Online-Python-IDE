<?php

$dir = __DIR__.'/..';
$pwd = __DIR__;
$artisan = $dir.'/artisan';

print shell_exec("cd $dir && composer install");
print shell_exec("cp $dir/.env.example $dir/.env");
print shell_exec("php $artisan key:generate");
print shell_exec("php $pwd/db_migrate.php");
print shell_exec("php $pwd/docker_template.php");
print shell_exec("php $pwd/docker_build.php");
