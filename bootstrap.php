<?php

error_reporting(E_ALL);

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$date = date("Y-m-d");

$container = new League\Container\Container;
require 'config/container.php';

$collection = new League\Route\RouteCollection($container);
$collection->setStrategy(new App\Route\RouteHandler);
$route = new App\Route\RouteCollector($collection);
require 'config/routes.php';
