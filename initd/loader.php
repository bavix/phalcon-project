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
    'Events'     => $configure->application->eventsDir,
    'Middleware' => $configure->application->middlewareDir,
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
