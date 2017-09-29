<?php

$loader = new \Phalcon\Loader();

/**
 * @var \Phalcon\DiInterface $di
 */

$configure = $di->get('configure');

/**
 * namespaces
 */
$loader->registerNamespaces([
    'Observers'  => $configure->application->observersDir,
    'Middleware' => $configure->application->middlewareDir,
    'Models'     => $configure->application->modelsDir,
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $configure->application->controllersDir,
    $configure->application->modelsDir,
]);

$loader->register();

return $loader;
