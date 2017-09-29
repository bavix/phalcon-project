<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

if (defined('BASE_PATH'))
{
    return [];
}

define('BASE_PATH', dirname(__DIR__) . '/');

return (new \Bavix\Config\Config(__DIR__))
    ->get('configure')
    ->asArray();
