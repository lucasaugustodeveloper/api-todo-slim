<?php

declare(strict_types=1);

use Slim\App;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;

// require __DIR__ . '/settings.php';
// require __DIR__ . '/dependencies.php';

// $app = AppFactory::create();
// $routes = require __DIR__ . '/routes.php';

// require __DIR__ . '/middleware.php';

// $routes($app);

// return $app;

function createApp(ContainerInterface $container): App
{
    AppFactory::setContainer($container);

    $app = AppFactory::create();

    $routes = require __DIR__ . '/routes.php';

    $routes($app);

    return $app;
}
