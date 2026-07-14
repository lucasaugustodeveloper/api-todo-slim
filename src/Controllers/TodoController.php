<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\CreateTodoDTO;
use App\DTO\UpdateTodoDTO;
use App\Services\TodoService;
use App\Exceptions\TodoNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TodoController
{
    public function __construct(
        private readonly TodoService $service
    ) { }

    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface
    {
        $todos = $this->service->findAll();

        $response->getBody()->write(
            json_encode(
                array_map(
                    fn($todo) => $todo->toArray(),
                    $todos
                )
            )
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function show(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        try {
            $todo = $this->service->findById(
                (int) $args['id']
            );

            $response->getBody()->write(
                json_encode($todo->toArray())
            );
        } catch (TodoNotFoundException $e) {
            $response->getBody()->write(
                json_encode([
                    'error' => $e->getMessage(),
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
    }

    public function store(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $data = json_decode(
            (string) $request->getBody(),
            true
        );

        try {
            $todo = $this->service->create(
                new CreateTodoDTO(
                    $data[ 'title'] ?? '',
                )
            );

            $response->getBody()->write(
                json_encode($todo->toArray())
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } catch(\InvalidArgumentException $e) {
            $response->getBody()->write(
                json_encode([
                    'error' => $e->getMessage()
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
    }

    public function update(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $data = json_decode(
            (string) $request->getBody(),
            true
        );

        try {
            $todo = $this->service->update(
                (int) $args['id'],
                new UpdateTodoDTO(
                    $data['title'] ?? '',
                    $data['completed'] ?? false
                )
            );
    
            $response->getBody()->write(
                json_encode($todo->toArray())
            );
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } catch (TodoNotFoundException $e) {
            $response->getBody()->write(
                json_encode([
                    'error' => $e->getMessage()
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
    }

        public function delete(
            ServerRequestInterface $request,
            ResponseInterface $response,
            array $args
        ): ResponseInterface
        {
            try {
                $this->service->delete(
                    (int) $args['id']
                );

                return $response->withStatus(200);
            } catch(TodoNotFoundException $e) {
                $response->getBody()->write(
                    json_encode([
                        'error' => $e->getMessage()
                    ])
                );

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
        }
}
