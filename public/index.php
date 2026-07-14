<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/container.php';
require __DIR__ . '/../app/app.php';

$container = createContainer();

$app = createApp($container);

$app->run();
