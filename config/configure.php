<?php

return [
    'database'    => '%database%',
    'application' => [
        'appDir'         => BASE_PATH . 'src/App/',
        'controllersDir' => BASE_PATH . 'src/App/Controller/',
        'migrationsDir'  => BASE_PATH . 'var/migrations/',
        'middlewareDir'  => BASE_PATH . 'var/middleware/',
        'observersDir'   => BASE_PATH . 'var/observers/',
        'queuesDir'      => BASE_PATH . 'var/queues/',
        'modelsDir'      => BASE_PATH . 'var/models/',
        'modulesDir'     => BASE_PATH . 'var/modules/',
        'viewsDir'       => BASE_PATH . 'var/views/',
        'pluginsDir'     => BASE_PATH . 'var/plugins/',
        'libraryDir'     => BASE_PATH . 'var/library/',
        'cacheDir'       => BASE_PATH . 'var/cache/',
        'baseUri'        => BASE_PATH,
    ]
];
