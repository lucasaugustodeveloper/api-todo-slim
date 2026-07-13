<?php

use Slim\Middleware\ErrorMiddleware;

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(
    true,
    true,
    true
);
