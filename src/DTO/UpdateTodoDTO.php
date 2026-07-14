<?php

declare(strict_types=1);

namespace App\DTO;

class UpdateTodoDTO
{
    public function __construct(
        private readonly string $title,
        private readonly bool $completed
    ) { }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}
