# Laravel :: Skeleton

## Requirements

 * [Docker]
 * [Docker Compose]

This project is relies on [Laravel 6] and provides a base for creating new projects.
In order to provide interoperability and achieve homogenized environments across
platforms, it uses Docker.
Locally, Docker Compose brings a multi-container setup. Except the commands related
to the source control system (`git`), the rest uses `docker-compose` as base. So,
please note that if you're checking some documentation outside this project that
requires a command to be executed (like `composer` or similar), you will
need to invoke before [`docker-compose run`] and the Docker service you want to execute:

    $ docker-compose run cli composer ...

In this case, "cli" is the service that provides all the CLI tools required by the
project, including `composer`.
You can also check the PHP version or anything else related to the CLI SAPI:

    $ docker-compose run cli php ...


## First Steps 

    $ docker-compose run cli composer install
    $ docker-compose run cli php artisan migrate --seed

## Summary

In this enviroment the /.docker/.env contain all the information Laravel's enviroment variables.
The Database inicial migration only create the user's skeleton on a Database table.
