<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->group('/users', function ($group) {
        $group->get('', function(Request $request, Response $response) {
            $response->getBody()->write(json_encode([
                'message' => "User root route",
            ]));
    
            return $response->withHeader('Content-type', 'application/json');
        });
    });
};
