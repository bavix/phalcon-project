<?php

/**
 * @var $router  \Phalcon\Mvc\Router
 * @var $di      \Phalcon\Di\FactoryDefault
 */
$router = $di->get('router');

$router->setDefaultNamespace('App\Controller');

//$router->add('/test', [
//    'controller' => 'index',
//    'action'     => 'test'
//]);

$router->handle();

return $router;
