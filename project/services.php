<?php

use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\ServerRequestFactory;
use Doctrine\DBAL\Query\QueryBuilder;

return [

    'request' => function(){
        return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
    },
    'response' => new Response(),
    'emitter' => new SapiEmitter(),    
    
    'stream' => new \Laminas\Diactoros\Stream('php://input'),    
    
    'jsonRouter' => function(){
		$responseFactory = new \Laminas\Diactoros\ResponseFactory();
		$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
		return (new League\Route\Router)->setStrategy($strategy);
	},
	
    'router' =>	 new League\Route\Router(),    
        
    'twig' => function (){
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
        return new \Twig\Environment($loader);
    },
    
    'queryBuilder' => function (){
		$options = [
			'dbname' =>   TOPAZ_DBNAME,
			'user' =>     TOPAZ_DBUSER,
			'password' => TOPAZ_DBPASS,
			'host' =>     TOPAZ_DBHOST,
			'driver' =>   TOPAZ_DBDRIVER,
		];	
		
		$connection = \Doctrine\DBAL\DriverManager::getConnection($options);
		return $connection->createQueryBuilder();
	},
	
	'validator' =>	Respect\Validation\Validator::class, 
	     	
	     	
     	
];







