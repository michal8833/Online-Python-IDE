<?php

$dir = __DIR__.'/..';
$pwd = __DIR__;
$artisan = $dir.'/artisan';

print shell_exec("cd $dir && composer install");
print shell_exec("cp $dir/.env.example $dir/.env");
print shell_exec("php $artisan key:generate");
require_once "db_migrate.php";
require_once "docker_template.php";
require_once "docker_build.php";
