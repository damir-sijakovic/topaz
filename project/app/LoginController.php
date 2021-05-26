<?php declare(strict_types=1);

namespace App;
use Sys\BaseController;
use Sys\Utils;
use Sys\Users;
use Sys\Encrypt;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;

use Model\LoginModel;


class LoginController extends BaseController 
{	
    public function indexAction(ServerRequestInterface $request ): ResponseInterface
    {
		$htmlContent = $this->twig->render('login.twig.html', [
				'name' => 'hello!',
				'root_path' => Utils::getRootUrl(),
		]);	
		
		$response = new \Laminas\Diactoros\Response\HtmlResponse(
			$htmlContent,
			200, [
				'Content-Type' => ['text/html;charset=UTF-8']				
			]
		);
		
					
		return $response;      

    }
    
    public function logoutAction(ServerRequestInterface $request ): ResponseInterface
    {
		
		$htmlContent = $this->twig->render('logout.twig.html', [
				'name' => 'hello!',
				'root_path' => Utils::getRootUrl(),
				'csrf_token' => Users::setCsrf(),
			]);	
		
		$response = new \Laminas\Diactoros\Response\HtmlResponse(
			$htmlContent,
			200, [
				'Content-Type' => ['text/html;charset=UTF-8']			
			]
		);
		
					
		return $response;      

    }
       
    
    public function loginPostAction(ServerRequestInterface $request ): ResponseInterface
	{
		$postData = json_decode($this->stream->getContents());

		$email = $postData->e;
		$password = $postData->p;
		
		$loginModel = new LoginModel();
		$modelUserData = $loginModel->getByEmail($email);
		
		$loginValid = false;
		
		if ($modelUserData)
		{
			$modelHashPassword = $modelUserData['password'];
			if (Encrypt::verifyPassword($password, $modelHashPassword))
			{
				Users::loginJwt($email);
				$loginValid = true;
			}
		}
		
		if ($loginValid)
		{
			return new JsonResponse([
					'success' => 'Logged on!',
				], 200,	['Content-Type' => ['application/json']]);
		}
		else
		{
			return new JsonResponse([
					'error' => 'Login failed!',
				], 200,	['Content-Type' => ['application/json']]);
		}
		
		return new JsonResponse(null, 500,	['Content-Type' => ['application/json']]);
    }
    
    public function logoutPostAction(ServerRequestInterface $request ): ResponseInterface
	{
		$postData = json_decode($this->stream->getContents());
		
		$csrf = $request->getHeader('x-csrf-token')[0];
		
		if ($csrf)
		{
			Users::logoutJwt($csrf);
		}
		
		return new JsonResponse(['ok'=>'ok'], 200,	['Content-Type' => ['application/json']]);
    }
    
    
    public function loginNullAction(ServerRequestInterface $request ): ResponseInterface
	{
		return new JsonResponse([null], 401,	['Content-Type' => ['application/json']]);
    }
    
    
    
    
}
