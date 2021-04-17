# Online IDE for Python
---
Online IDE for Python made with PHP and Laravel.
## Main Features:
- Managing Users
    - Creating account
    - User login to the account
- Managing Projects
    - Creating and deleting projects
    - Renaming project
    - Adding description to project
    - Managing files:
        - Creating new files
        - Importing files.
        - Editing and saving files.
        - Renaming files.
- Running projects
    - Passing project files to interpreter (Docker)
    - Passing cmd arguments to interpreter
    - Showing project output (stdout and stderr)
    - Managing simple input

## How to run correctly
Run:
- `php scripts/run.php` - Should be enough as long as the docker image is built and the database migrated and seeded. (run docker_build and db_restart to make sure it will work)

First time configuration and running:

1. `php scripts/setup_repo.php`
2. `php scripts/db_restart.php`
3. `php scripts/docker_build.php`
2. `php scripts/run.php`

## Scripts
All scripts should be in the /project/scripts directory and are configured from the .env file

- **db_kill** - kills the database container if its running
- **db_migrate** - migrate and seed the database, then sqldump
- **db_start** - start up the mysql database
- **db_restart** - all of the db_* scripts, restarts and migrates the database
- **docker_build** - build the docker image
- **run** - runs the application server (starts database and python interpreter containers if they're not running)
- **setup_repo** - use after cloning the repo to set it up


