<?php

return [
    'app' => [
        'namespace' => Modules\App\Controllers::class,
        'className' => Modules\App\Module::class,
        'path'      => BASE_PATH . 'src/Modules/App/Module.php'
    ],
    'foo' => [
        'namespace' => Modules\Foo\Controllers::class,
        'className' => Modules\Foo\Module::class,
        'path'      => BASE_PATH . 'src/Modules/Foo/Module.php'
    ],
];
