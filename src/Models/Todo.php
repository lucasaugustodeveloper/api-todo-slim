<?php

declare(strict_types=1);

namespace App\Models;

class Todo
{
    public function __construct(
        private int $id,
        private string $title,
        private bool $completed = false
    ) {
    }

    public static function create(
        string $title
    ): self {
        return new self(
            0,
            $title,
            false
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function toggleCompleted(): void
    {
        $this->completed = !$this->completed;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'completed' => $this->completed,
        ];
    }
}
