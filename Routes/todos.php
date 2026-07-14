<?php

declare(strict_types=1);

use App\Controllers\TodoController;
use Slim\App;
use Slim\Routing\RouteControllerProxy;

return function (App $app) {
    $app->group('/todos', function ($group) {
        $group->get('', [
            TodoController::class,
            'index'
        ]);

        $group->get('{id}', [
            TodoController::class,
            'show'
        ]);

        $group->post('', [
            TodoController::class,
            'store'
        ]);

        $group->put('/{id}', [
            TodoController::class,
            'update'
        ]);

        $group->delete('/{id}', [
            TodoController::class,
            'delete'
        ]);
    });
};
