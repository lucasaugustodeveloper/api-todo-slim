<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode([
            'version' => '0.0.1',
            'message' => 'Enjoy the silence...',
        ]));

        return $response->withHeader('Content-type', 'application/json');
    });
};
