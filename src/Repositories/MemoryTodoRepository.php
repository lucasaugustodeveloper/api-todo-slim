<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Todo;
use App\Exceptions\TodoNotFoundException;
use App\Interfaces\TodoRepositoryInterface;

class MemoryTodoRepository implements TodoRepositoryInterface
{

    public function __construct()
    {
        error_log(
            'MemoryTodoRepository criado: ' . spl_object_id($this)
        );
    }


    /**
     * @var Todo[]
     */
    private array $todos = [];

    private int $nextId = 1;

    /**
     * @return Todo[]
     */
    public function findAll(): array
    {
        error_log(
            'findAll repository: ' . spl_object_id($this)
            . ' total=' . count($this->todos)
        );

        return array_values($this->todos);
    }

    public function findById(int $id): ?Todo
    {
        return $this->todos[$id] ?? null;
    }

    public function create(Todo $todo): Todo
    {
        error_log(
            'create repository: ' . spl_object_id($this)
        );

        $todo->setId($this->nextId);

        $this->todos[$this->nextId] = $todo;

        $this->nextId++;

        return $todo;
    }

    public function update(Todo $todo): Todo
    {
        $id = $todo->getId();

        if ($id === null || !isset($this->todos[$id])) {
            throw new TodoNotFoundException($id ?? 0);
        }

        $this->todos[$id] = $todo;

        return $todo;
    }

    public function delete(int $id): void
    {
        if (!isset($this->todos[$id])) {
            throw new TodoNotFoundException($id);
        }

        unset($this->todos[$id]);
    }
}
