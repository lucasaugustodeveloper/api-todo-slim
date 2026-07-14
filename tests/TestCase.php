<?php

namespace Tests;

use Slim\App;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected App $app;

    protected function setUp(): void
    {
        parent::setUp();

        require_once __DIR__ . '/../app/container.php';
        require_once __DIR__ . '/../app/app.php';

        $container = createContainer(true);

        $this->app = createApp($container);
    }
}
