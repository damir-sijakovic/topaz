<?php declare(strict_types=1);

namespace App;

use Sys\BaseController;
use Sys\Utils;
use Sys\Encrypt;
use Model\ArticleModel;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;


class ArticleController extends BaseController 
{	
	
    public function indexAction(ServerRequestInterface $request ): ResponseInterface
    {
		$articleModel = new ArticleModel();
		$articleList = $articleModel->getAll();

        $response = new Response;        
        $response->getBody()->write(
			$this->twig->render('article.twig.html', [
				'name' => 'hello!',
				'root_path' => Utils::getRootUrl(),
				'article_list' => $articleList,
			])
		);
		
		return $response;        
    }
    
        
    public function addAction(ServerRequestInterface $request ): ResponseInterface
	{
        $response = new Response;        
        $response->getBody()->write(
			$this->twig->render('article_add.twig.html', [
				'name' => 'hello!',
				'root_path' => Utils::getRootUrl(),			
			])
		);
		
		return $response;        
    }
    
        
    public function addPostAction(ServerRequestInterface $request ): ResponseInterface
    {				
		$postData = json_decode($this->stream->getContents());
			
		$title = urldecode(base64_decode($postData->title));
		$body = $postData->body;

		$articleModel = new ArticleModel();
		$articleAdded = $articleModel->add($title, $body);		        
        
        if ($articleAdded)
		{
			return new JsonResponse([
					'success' => 'ok',
				], 200,	['Content-Type' => ['application/json']]);
		}
		else
		{
			return new JsonResponse([
					'error' => 'Failed to read article!',
				], 403,	['Content-Type' => ['application/json']]);
		}        
                
                
		return new JsonResponse(null, 500,	['Content-Type' => ['application/json']]);

    }
    
    public function getByIdPostAction(ServerRequestInterface $request ): ResponseInterface
    {			
		$postData = json_decode($this->stream->getContents());			
		$id = $postData->id;	
		
		$articleModel = new ArticleModel();
		$article = $articleModel->getById($id);
		$title = $article['title'];
		$body = $article['body'];
		
		$data = [
				'title'   => $title,
				'body' => $body,
		];	
				
        if ($article)
		{
			return new JsonResponse([
					'success' => [
                        'title'   => $title,
                        'body' => $body,
                    ],
				], 200,	['Content-Type' => ['application/json']]);
		}
		else
		{
			return new JsonResponse([
					'error' => 'Failed to read article!',
				], 403,	['Content-Type' => ['application/json']]);
		}        
                
                
		return new JsonResponse(null, 500,	['Content-Type' => ['application/json']]);

    }
    
    public function deleteIdPostAction(ServerRequestInterface $request ): ResponseInterface
    {			
		$postData = json_decode($this->stream->getContents());			
		$id = $postData->id;	
		
		$articleModel = new ArticleModel();
		$deleteOk = $articleModel->deleteId($id);
			
        if ($deleteOk)
		{
			return new JsonResponse([
					'success' => 'Article deleted!',
				], 200,	['Content-Type' => ['application/json']]);
		}
		else
		{
			return new JsonResponse([
					'error' => 'Failed to delete article!',
				], 304,	['Content-Type' => ['application/json']]);
		}
				
		return new JsonResponse(null, 500,	['Content-Type' => ['application/json']]);

    }
    
    
        
}
