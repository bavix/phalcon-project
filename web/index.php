<?php

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__) . '/');
include_once BASE_PATH . '/vendor/autoload.php';

$builder = new \Framework\Builder(BASE_PATH);
$builder->app()->terminate();
