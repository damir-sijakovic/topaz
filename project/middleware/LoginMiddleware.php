<?php declare(strict_types=1);

namespace Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

use Sys\Users;


class LoginMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /*
        if ($request->getServerParams()['REQUEST_URI'] !== '/login')
        {            
           return new RedirectResponse('/login');
        }
        */
        
        if (Users::isJwtExpired())
        {
            Users::logoutJwt(Users::forceLogoutJwt());
        }
        
        if (Users::isUserLoggedOn())
        {
            
            return new RedirectResponse('/logout');
        }
        
        
        return $handler->handle($request);

    }
}
