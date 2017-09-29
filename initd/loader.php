<?php

$loader = new \Phalcon\Loader();

/**
 * namespaces
 */
$loader->registerNamespaces([
    'Observers'  => $config->application->observersDir,
    'Events'     => $config->application->eventsDir,
    'Middleware' => $config->application->middlewareDir,
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir,
]);

$loader->register();

return $loader;
