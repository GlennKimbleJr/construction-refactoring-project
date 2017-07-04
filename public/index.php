<?php 

require '../bootstrap.php';

try {
    $container->get('emitter')->emit(
        $route->collect()->dispatch(
            $container->get('request'), 
            $container->get('response')
        ));
}

catch (\RuntimeException $e) {
    echo displayError($container->get('League\Plates\Engine'), $e->getMessage());
}

catch (League\Route\Http\Exception\NotFoundException $e) {
    echo displayError($container->get('League\Plates\Engine'), $e->getMessage());
}

catch (App\Exceptions\MissingRecordException $e) {
    echo displayError($container->get('League\Plates\Engine'), $e->getMessage());
}

function displayError($template, $message) 
{
    return $template->render('message', [
        'template' => 'error',
        'message' => $message
    ]);
}