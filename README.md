## Online IDE for Python
[write description here]

## How to run correctly
Run:
- `php scripts/run.php` - Should be enough as long as the Dockerfile is templated, the image built and the database migrated and seeded. (run docker_restart and db_restart to make sure it will work)

First time configuration and running:

1. `php scripts/first_run.php`
2. `php scripts/run.php`

OR:

1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `php scripts/db_migrate.php`
5. `php scripts/docker_template.php`
6. `php scripts/docker_build.php`
7. `php scripts/run.php`

## Scripts
All scripts should be in the /project/scripts directory and are configured from the .env file

- **db_kill** - kills the database container if its running
- **db_migrate** - migrate and seed the database, then sqldump
- **db_start** - start up the mysql database
- **db_restart** - all of the db_* scripts, restarts and migrates the database
- **docker_kill** - kills the python interpreter container if its running
- **docker_template** - create a Dockerfile template based on Dockerfile_template in /project/docker (must be done before docker_start)
- **docker_build** - build the docker image
- **docker_start** - start the docker container with the python interpreter
- **docker_restart** - all of the docker_* scripts, rebuilds the python interpreter image and restarts it
- **run** - runs the application server (starts database and python interpreter containers if they're not running)
- **first_run** - use after cloning the repo to set it up


