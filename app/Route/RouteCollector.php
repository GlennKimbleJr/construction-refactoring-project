<?php

namespace App\Route;

use League\Route\RouteCollection;

class RouteCollector
{
    /**
     * @var League\Route\RouteCollection
     */
    protected $collection;

    /**
     * Path to the controllers directory.
     *
     * @var string
     */
    protected $controller_dir = 'App\Controllers\\';

    /**
     * @param League\Route\RouteCollection $collection
     */
    public function __construct(RouteCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Return the RouteCollection instance.
     *
     * @return League\Route\RouteCollection
     */
    public function collect()
    {
        return $this->collection;
    }

    /**
     * Map a GET request to the route collection.
     *
     * @param  string $route
     * @param  string $controller
     * @return void
     */
    public function get($route, $controller)
    {
        return $this->collection->map('GET', $route, $this->resolve($controller));
    }

    /**
     * Map a POST request to the route collection.
     *
     * @param  string $route
     * @param  string $controller
     * @return void
     */
    public function post($route, $controller)
    {
        return $this->collection->map('POST', $route, $this->resolve($controller));
    }

    /**
     * Map a resourceful collection of GET and POST request to the route collection.
     *
     * @param  string $resource
     * @param  string $controller
     * @return void
     */
    public function resource($resource, $controller = NULL)
    {
        if (! $controller) {
            $controller = ucfirst($resource) . 'Controller';
        }

        return $this->collection->group("/{$resource}", function ($router) use ($controller) {
            $router->get('/', $this->resolve("{$controller}@index"));
            $router->get('/create[/]', $this->resolve("{$controller}@create"));
            $router->get('/{id:number}[/]', $this->resolve("{$controller}@show"));
            $router->get('/{id:number}/edit[/]', $this->resolve("{$controller}@edit"));
            $router->get('/{id:number}/delete[/]', $this->resolve("{$controller}@delete"));

            $router->post('/', $this->resolve("{$controller}@store"));
            $router->post('/{id:number}', $this->resolve("{$controller}@update"));
            $router->post('/{id:number}/delete', $this->resolve("{$controller}@destroy"));
        });
    }

    /**
     * Return the path to the controller.
     *
     * @param  string $controller
     * @return string
     */
    protected function resolve($controller) {
        return $this->controller_dir . str_replace('@', '::', $controller);
    }
}
