<?php

return [
    'database'    => [
        'adapter'  => 'cli' === PHP_SAPI ? 'Mysql' : Phalcon\Db\Adapter\Pdo\Mysql::class,
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'test',
        'charset'  => 'utf8',
    ],
];
