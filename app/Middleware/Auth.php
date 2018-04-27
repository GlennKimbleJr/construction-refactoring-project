<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Exceptions\UnauthenticatedUserException;

class Auth
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (! auth()->check()) {
            throw new UnauthenticatedUserException();
        }

        return $next($request, $response);
    }
}
