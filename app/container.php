<?php

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

function createContainer(bool $testing = false): ContainerInterface
{
    $dotenv = $testing
        ? Dotenv::createImmutable(dirname(__DIR__), '.env.testing')
        : Dotenv::createImmutable(dirname(__DIR__), '.env');
    
    $dotenv->safeLoad();

    $builder = new ContainerBuilder;

    require __DIR__ . '/settings.php';

    $builder->addDefinitions(
        require __DIR__ . '/dependencies.php'
    );

    if ($testing) {
        $builder->addDefinitions(
            require __DIR__ . '/dependencies.testing.php'
        );
    }

    return $builder->build();
}
