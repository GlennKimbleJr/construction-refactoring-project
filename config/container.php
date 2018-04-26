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

$container->add('Psr\Http\Message\RequestInterface', $container->get('request'));

$container->add('League\Plates\Engine', function () {
    return new League\Plates\Engine('../views');
}, true);

$container->add('App\Database', function () {
    $host = getenv('DB_' . strtoupper(getenv('APP_ENV')) . '_HOST');
    $database = getenv('DB_' . strtoupper(getenv('APP_ENV')) . '_DATABASE');
    $username = getenv('DB_' . strtoupper(getenv('APP_ENV')) . '_USERNAME');
    $password = getenv('DB_' . strtoupper(getenv('APP_ENV')) . '_PASSWORD');

    return new App\Database("mysql:host={$host};dbname={$database};", $username, $password);
}, true);

$container->share('auth', function () use ($container) {
    return new Delight\Auth\Auth($container->get('App\Database')->getPdoObject());
});
