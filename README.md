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

The `5432` port must be free for PostgreSQL.

    composer install
    make start

Then open [https://127.0.0.1:8000](https://127.0.0.1:8000)

The port can change if `8000` is already used.


## Reset

To reinitialize the database you can run:

    make db-init


## Stop the Docker containers and the Symfony web server

    make stop


### Manual update

You can also manually emit notifications in your application check out
[AppController](./src/Controller/AppController.php):

      $topic = $this->adminUrlGenerator->setController(Article::class)
              ->unsetAllExcept('crudControllerFqcn')->generateUrl();
      $update = new Update(
          $topic,
          (string) json_encode(['id' => 1]),
      );

Of course you should rely on an actual article instance in this case.

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
