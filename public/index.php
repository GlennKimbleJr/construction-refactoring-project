<?php 

require '../bootstrap.php';

try {
    $container->get('emitter')->emit(
        $route->collect()->dispatch(
            $container->get('request'), 
            $container->get('response')
        ));
}

catch (League\Route\Http\Exception\NotFoundException $e) {
    echo '404 Not Found';
}

catch (\RuntimeException $e) {
    echo $e;
}
