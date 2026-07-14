<?php

declare(strict_types=1);

namespace App\Contracts\Repository;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    /**
     * Return all tasks
     * 
     * @return Todo[]
     */
    public function findAll(): array;

    /**
     * Search task for ID
     */
    public function findById(int $id): ?Todo;

    /**
     * Save new task
     */
    public function create(Todo $todo): Todo;

    /**
     * Update the exist task
     */
    public function update(Todo $todo): Todo;

    /**
     * Delete the task
     */
    public function delete(int $id): void;
}
