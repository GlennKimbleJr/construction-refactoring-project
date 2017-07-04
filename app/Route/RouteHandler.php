<?php 

namespace App\Route;

use \Exception;
use \RuntimeException;
use League\Route\Route;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\StrategyInterface;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\Exception\MethodNotAllowedException;

class RouteHandler implements StrategyInterface 
{
    /**
     * {@inheritdoc}
     */
    public function getCallable(Route $route, array $vars)
    {
        return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($route, $vars) {
            
            $response = call_user_func_array(
                $route->getCallable(), 
                $this->setParamsForMethod($route, $vars, $request)
            );

            if (! $response instanceof ResponseInterface) {
                throw new RuntimeException(
                    'Route callables must return an instance of (Psr\Http\Message\ResponseInterface)'
                );
            }

            return $next($request, $response);
        };
    }

    /**
     * Determin if the request object should be prepended to the $vars array.
     * 
     * @param League\Route\Route     $route   
     * @param array                  $vars    
     * @param Psr\Http\Message\ServerRequestInterface $request 
     */
    public function setParamsForMethod(Route $route, array $vars, ServerRequestInterface $request) 
    {
        $callable = $route->getCallable();
        $ReflectionMethod =  new \ReflectionMethod($callable[0], $callable[1]);

        if (isset($ReflectionMethod->getParameters()[0]) 
            && strpos($ReflectionMethod->getParameters()[0], '$request') !== false) {
            array_unshift($vars, $request);
        }

        return $vars;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotFoundDecorator(NotFoundException $exception)
    {
        throw $exception;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception)
    {
        throw $exception;
    }

    /**
     * {@inheritdoc}
     */
    public function getExceptionDecorator(Exception $exception)
    {
        throw $exception;
    }
}