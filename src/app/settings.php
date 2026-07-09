<?php

use DI\Container;

$container = new Container();

$container->set('settings', [
    'displayErrorDetails' => true,
]);

return $container;
