<?php

use DI\Container;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

AppFactory::setContainer($container);

return $container;
