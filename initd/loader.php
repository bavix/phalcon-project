<?php

$loader = new \Phalcon\Loader();

/**
 * @var \Phalcon\DiInterface $di
 */

$configure = $di->get('configure');

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([]);
$loader->register();

return $loader;
