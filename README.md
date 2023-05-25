# EasyAdmin / Mercure demo

## Features

* While I edit an entity which gets updated on the server by another user, I get
  a notification and a button for updating the page I'm looking at.
* While I am looking at an entity list, if a an entity on the page gets updated
  on the server by another user, I get a notification, a button for updating the page I'm looking
  at and the outdated entity gets highlighted.

This demo application has been generated from the [MicroSymfony](https://github.com/strangebuzz/MicroSymfony)
template.


## Requirements

* Docker
* [PHP 8.1](https://www.php.net/releases/8.1/en.php)
* The [Symfony CLI](https://symfony.com/download)


## Installation & first run 🚀

    docker compose up -d

Get the port of the database service:

    docker ps
    CONTAINER ID   IMAGE                COMMAND                  CREATED        STATUS        PORTS                                      NAMES
    7d92568b7dfa   dunglas/mercure      "/usr/bin/caddy run …"   22 hours ago   Up 22 hours   443/tcp, 2019/tcp, 0.0.0.0:59908->80/tcp   easyadmin-mercure-demo-mercure-1
    5a7d735b92a5   postgres:15-alpine   "docker-entrypoint.s…"   23 hours ago   Up 23 hours   0.0.0.0:59629->5432/tcp                    easyadmin-mercure-demo-database-1
    
    docker port 5a7d735b92a5
    5432/tcp -> 0.0.0.0:59629

So the local public port of the Docker database service is `59269`.

In a `env.local` file at the root of the project file, put:

    DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:59629/app?serverVersion=15&charset=utf8"

You can now run:

    composer install
    make start

Then open [https://127.0.0.1:8000](https://127.0.0.1:8000)

The port can change if 8000 is already used.


## Todo


## To try/test


## Stack 🔗

* [Symfony 6.3](https://symfony.com)
* [Twig 3](https://twig.symfony.com)
* [PHPUnit 9.5](https://phpunit.de)
* The classless [BareCSS](http://barecss.com) CSS framework 


## Dev-tools ✨
 
* php-cs-fixer with the [Symfony ruleset and PHP strict types](https://github.com/strangebuzz/MicroSymfony/blob/main/.php-cs-fixer.dist.php)
* PHPStan at [maximum level](https://github.com/strangebuzz/MicroSymfony/blob/main/phpstan.neon)
* A simple [Makefile](https://github.com/strangebuzz/MicroSymfony/blob/main/Makefile)
