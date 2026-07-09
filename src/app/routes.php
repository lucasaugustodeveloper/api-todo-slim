<?php

use Slim\App;

return function(App $app) {
    $routesPath = __DIR__ . '/../Routes';
    $files = glob($routesPath . '/*.php');

    foreach($files as $file) {
        $route = require $file;

        if (is_callable($route)) {
            $route($app);
        }
    }
};
