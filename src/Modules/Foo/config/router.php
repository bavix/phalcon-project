<?php

/**
 * @var $this    \Framework\Builder
 * @var $router  \Phalcon\Mvc\Router
 * @var $data    array
 */
$router->add('/', [
    'controller' => 'index',
    'action'     => 'index'
]);

$router->add('/:action', [
    'controller' => 'index',
    'action'     => 1
]);
