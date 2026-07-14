<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Todo;
use App\DTO\CreateTodoDTO;
use App\DTO\UpdateTodoDTO;
use App\Exceptions\TodoNotFoundException;
use App\Contracts\Repository\TodoRepositoryInterface;

class TodoService
{
    public function __construct(
        private readonly TodoRepositoryInterface $repository
    ) { }

    /**
     * @return Todo[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): Todo
    {
        $todo = $this->repository->findById($id);

        if ($todo === null) {
            throw new TodoNotFoundException($id);
        }

        return $todo;
    }

    public function create(CreateTodoDTO $dto): Todo
    {
        $title = trim($dto->getTitle());

        if ($title === '') {
            throw new \InvalidArgumentException(
                'O título da tarefa é obrigatório'
            );
        }

        $todo = Todo::create($title);

        return $this->repository->create($todo);
    }

    public function update(int $id, UpdateTodoDTO $dto): Todo
    {
        $todo = $this->findById($id);
        $title = trim($dto->getTitle());

        if ($title === '') {
            throw new \InvalidArgumentException(
                'O título da tarefa é obrigatório'
            );
        }

        $todo->setTitle($title);
        $todo->setCompleted($dto->isCompleted());

        return $this->repository->update($todo);
    }

    public function delete(int $id): void
    {
        $this->findById($id);

        $this->repository->delete($id);
    }
}
