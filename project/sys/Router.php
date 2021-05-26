<?php

namespace Sys;
use Sys\ServiceContainer;
use Sys\Utils;

use Laminas\Diactoros\Response\RedirectResponse;


class Router
{
	private $router;  
	private $jsonRouter;
	private $request;  
	private $emitter;  
	private $routeList;
	
	public function __construct() 
	{		
		$this->router     = ServiceContainer::get('router');
		$this->jsonRouter = ServiceContainer::get('jsonRouter');
		$this->request    = ServiceContainer::get('request');
		$this->emitter    = ServiceContainer::get('emitter');	
		$this->routeList  =	require_once(TOPAZ_ROUTES_FILE);
	}
	
	public function init()
	{
        
        
		for ($i=0; $i<count($this->routeList); $i++)
		{
            list($requestType, $route, $controller, $middleware) = $this->routeList[$i];            
           
            if ($middleware)
            {     
                if ($requestType === 'GET')
                {
                    $this->router->map('GET', $route, $controller)->middleware(new $middleware);
                }
                else if ($requestType === 'POST')
                {
                    $this->jsonRouter->map('POST', $route, $controller)->middleware(new $middleware);
                }
            }
            else
            {                
                if ($requestType === 'GET')
                {
                    $this->router->map('GET', $route, $controller);
                }
                else if ($requestType === 'POST')
                {
                    $this->jsonRouter->map('POST', $route, $controller);
                }            
            } 
		}

        
		
		if ($this->request->getServerParams()['REQUEST_METHOD'] === 'GET')
		{
			$response = $this->router->dispatch($this->request);
		}
		else
		{
			$response = $this->jsonRouter->dispatch($this->request);
		}
		        

        
        $this->emitter->emit($response);		
	}
	
}


