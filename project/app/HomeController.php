<?php declare(strict_types=1);

namespace App;
use Sys\BaseController;
use Sys\Utils;
use Sys\Encrypt;

use Model\UserModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;

class HomeController extends BaseController 
{	
    public function indexAction(ServerRequestInterface $request ): ResponseInterface
    {

        $response = new Response;        
        $response->getBody()->write(
			$this->twig->render('home.twig.html', [
				'name' => 'hello!',
				'root_path' => Utils::getRootUrl()
			])
		);
		
		return $response;        
    }
    
    
    public function postAction(ServerRequestInterface $request ): ResponseInterface
    {		
		$data = [
				'title'   => 'My New Simple API',
				'version' => 1,
		];	
				
		return new JsonResponse($data, 200,	['Content-Type' => ['application/json']]);

    }
    
    
    
    
}
