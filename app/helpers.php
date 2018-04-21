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
