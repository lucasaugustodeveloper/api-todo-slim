<?php

namespace Tests\Integration;

use Slim\Psr7\Factory\ServerRequestFactory;
use Tests\TestCase;

class TodoRoutesTest extends TestCase
{
    public function testTodoReturns200()
    {
        $request = (new ServerRequestFactory())
            ->createServerRequest('GET', '/todos');

            $response = $this->app->handle($request);

            $this->assertEquals(200, $response->getStatusCode());
    }
}
