<?php

use Slim\Factory\AppFactory;
use App\Services\TodoService;
use App\Controllers\TodoController;
use App\Repositories\PostgresTodoRepository;
use App\Contracts\Repository\TodoRepositoryInterface;

use function DI\autowire;

return [
    PDO::class => function () {
        $dns = sprintf(
            '%s:host=%s;port=%s;dbname=%s',
            $_ENV['DB_DRIVER'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_NAME'],
        );

        return new PDO(
            $dns,
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    },

    TodoRepositoryInterface::class => autowire(PostgresTodoRepository::class),
    TodoService::class => autowire(),
    TodoController::class => autowire(),
];
