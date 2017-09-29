<?php

return [
    'database'    => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'test',
        'charset'  => 'utf8',
    ],
    'application' => [
        'appDir'         => BASE_PATH . 'src/App/',
        'controllersDir' => BASE_PATH . 'src/App/Controller/',
        'modelsDir'      => BASE_PATH . 'var/models/',
        'migrationsDir'  => BASE_PATH . 'var/migrations/',
        'observersDir'   => BASE_PATH . 'var/observers/',
        'middlewareDir'  => BASE_PATH . 'var/middleware/',
        'viewsDir'       => BASE_PATH . 'var/views/',
        'pluginsDir'     => BASE_PATH . 'var/plugins/',
        'libraryDir'     => BASE_PATH . 'var/library/',
        'cacheDir'       => BASE_PATH . 'var/cache/',
        'baseUri'        => BASE_PATH,
    ]
];
