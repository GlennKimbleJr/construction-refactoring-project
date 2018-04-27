<?php

if (! function_exists('exception_handler')) {
    function exception_handler($exception) {
        $type = get_class($exception);

        if ($type == 'App\Exceptions\UnauthenticatedUserException') {
            header('Location: /auth/login'); die();
        }

        die($exception->getMessage());
    }
}
