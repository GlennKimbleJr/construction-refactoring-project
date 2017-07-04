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
        $this->collection->map('GET', $route, $this->resolve($controller));
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
        $this->collection->map('POST', $route, $this->resolve($controller));
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
        if (! $controller) $controller = ucfirst($resource) . 'Controller';

        $this->get('/'.$resource.'[/]', "{$controller}@index");
        $this->get('/'.$resource.'/create[/]', "{$controller}@create");
        $this->get('/'.$resource.'/{id:number}[/]', "{$controller}@show");
        $this->get('/'.$resource.'/{id:number}/edit[/]', "{$controller}@edit");
        $this->get('/'.$resource.'/{id:number}/delete[/]', "{$controller}@delete");
        
        $this->post('/'.$resource.'[/]', "{$controller}@store");
        $this->post('/'.$resource.'/{id:number}', "{$controller}@update");
        $this->post('/'.$resource.'/{id:number}/delete', "{$controller}@destroy");
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
