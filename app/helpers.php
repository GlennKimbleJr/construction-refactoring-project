<?php

if (! function_exists('dd')) {
    function dd(...$foo) {
        echo '<pre>';

        foreach ($foo as $f) {
            var_dump($f);
        }

        die();
    }
}

if (! function_exists('auth')) {
    function auth() {
        global $container;

        return $container->get('auth');
    }
}

if (! function_exists('navClass')) {
    function navClass($name, $route_path) {
        $route_path = explode('/', $route_path);

        return strpos($route_path[1], $name) !== false ? 'nav-link active' : 'nav-link';
    }
}
