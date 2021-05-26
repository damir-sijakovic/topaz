<?php declare(strict_types=1);

namespace Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

use Sys\Users;

class PostMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {        
 
        if (!Users::isLoginValidJwt())
        {
            Users::forceLogoutJwt();
            return new RedirectResponse('/login');
        }
        
        
        if (!Users::isUserLoggedOn())
        {
            return new RedirectResponse('/login/unauthorized');
        }

        return $handler->handle($request);

    }
}
