<?php declare(strict_types=1);

namespace App;
use Sys\BaseController;
use Sys\Utils;
use Sys\Encrypt;
use Sys\Users;

use Model\UserModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;

class FourZeroFourController extends BaseController 
{	
    public function indexAction(ServerRequestInterface $request ): ResponseInterface
    {
        $response = new Response;   
             
        $response->getBody()->write(
			$this->twig->render('fourzerofour.twig.html', [
				'root_path' => Utils::getRootUrl(),
			])
		);
		
		return $response;        
    }
       
    
}
