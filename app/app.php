<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/settings.php';
require __DIR__ . '/dependencies.php';

$app = AppFactory::create();
$routes = require __DIR__ . '/routes.php';

require __DIR__ . '/middleware.php';

$routes($app);

return $app;
