<?php

namespace Tests\Fakes;

use App\Models\Todo;
use App\Contracts\Repository\TodoRepositoryInterface;

class FakeTodoRepository implements TodoRepositoryInterface
{
    public function findAll(): array
    {
        return [
            new Todo(
                1,
                'Aprender PHPUnit',
                false
            )
        ];
    }

    public function findById(int $id): ?Todo
    {
        return new Todo(
            $id,
            'Aprender PHPUnit',
            false
        );
    }

    public function create(Todo $todo): Todo
    {
        return new Todo(
            1,
            $todo->title,
            $todo->completed
        );
    }

    public function update(Todo $todo): Todo
    {
        return new Todo(
            1,
            $todo->title,
            $todo->completed
        );
    }

    public function delete(int $id): void
    {
        return;
    }
}
