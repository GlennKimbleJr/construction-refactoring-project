<?php 

$container->delegate(new League\Container\ReflectionContainer);

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$container->share('response', Zend\Diactoros\Response::class);

$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->add('Psr\Http\Message\ResponseInterface', $container->get('response'));

$container->add('League\Plates\Engine', function () {
    return new League\Plates\Engine('../views');
}, true);

$container->add('App\Database', function () {
    return new App\Database('mysql:host=localhost;dbname=construction;', 'root', '');
}, true);
