# TOPAZ FRAMEWORK

## Custom framework composed of various PHP libs/modules

Fun little project of creating, going through a lot of docs and gluing 
everything together into something useful. 

#### Using libraries:
* php-di/php-di - dependency injection container
* league/route - router and middleware
* twig - template engine
* doctrine/dbal - database abstraction layer
* respect/validation - validator
* firebase/php-jwt - jwt token encoder/decoder
* tracy/tracy - logger, profiler and debugger

#### Files:
* bootstrap.php - file that gets called from index.php 
* config.php - project configuration 
* services.php - di container init
* routes.php - route, controller, middleware table

#### Dirs:
* app - controllers 
* templates - twig templates
* sys - singletons, helpers
* middleware - 
* model -


## Setup

### Prerequisites
Docker, PHP/Composer and optionally (Linux with Portainer).

### First set R/W permissions of downloaded project directory
In your filemanager set group and others access to read/write.


### Composer libs installation
Cd into ./project and run:

        composer install

### Building

In root (where docker-compose.yml file is) run:
        
        docker compose build
        
### Starting container

        docker compose up
        
        
### Project ports        

* localhost:80 - main project
* localhost:8080 - phpmyadmin
