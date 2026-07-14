<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;
use App\Models\Todo;
use App\Contracts\Repository\TodoRepositoryInterface;

class PostgresTodoRepository implements TodoRepositoryInterface
{
    public function __construct(
        private readonly PDO $pdo
    ) {
    }

    /**
     * @return Todo[]
     */
    public function findAll(): array
    {
        $statement = $this->pdo->query(
            'SELECT id, title, completed FROM todos ORDER BY id'
        );

        $todos = [];

        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $todos[] = new Todo(
                (int) $data['id'],
                $data['title'],
                (bool) $data['completed']
            );
        }

        return $todos;
    }

    public function findById(int $id): ?Todo
    {
        $statement = $this->pdo->prepare(
            'SELECT id, title, completed FROM todos WHERE id = :id'
        );

        $statement->execute([
            'id' => $id
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Todo(
            (int) $data['id'],
            $data['title'],
            (bool) $data['completed']
        );
    }

    public function create(Todo $todo): Todo
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO todos (title, completed)
            VALUES (:title, :completed)
            RETURNING id'
        );

        $statement->bindValue(
            ':title',
            $todo->getTitle(),
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':completed',
            $todo->isCompleted(),
            PDO::PARAM_BOOL
        );

        $statement->execute();

        $todo->setId(
            (int) $statement->fetchColumn()
        );

        return $todo;
    }

    public function update(Todo $todo): Todo
    {
        $statement = $this->pdo->prepare(
            'UPDATE todos
                SET title = :title,
                    completed = :completed
                        WHERE id = :id'
        );

        $statement->execute([
            'title' => $todo->getTitle(),
            'completed' => $todo->isCompleted(),
            'id' => $todo->getId()
        ]);

        return $todo;
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM todos WHERE id = :id'
        );

        $statement->execute([
            'id' => $id
        ]);
    }
}
