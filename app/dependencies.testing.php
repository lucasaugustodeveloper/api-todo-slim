<?php

use App\Contracts\Repository\TodoRepositoryInterface;
use Tests\Fakes\FakeTodoRepository;

use function DI\autowire;

return [
    TodoRepositoryInterface::class =>
        autowire(FakeTodoRepository::class),
];
