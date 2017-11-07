<?php

//$router->add('/', [
//    'controller' => 'index',
//    'action'     => 'index'
//]);

// error 404
$router->add('/404', [
    'namespace'  => Controllers::class,
    'controller' => 'response',
    'action'     => 'notFound'
]);

$router->notFound([
    'namespace'  => Controllers::class,
    'controller' => 'response',
    'action'     => 'notFound'
]);
// /error 404
