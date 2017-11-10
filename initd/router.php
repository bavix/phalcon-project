<?php

/**
 * @var $router  \Phalcon\Mvc\Router
 * @var $di      \Phalcon\Di\FactoryDefault
 * @var $this    \Framework\Builder
 */
$router = $di->get('router');

/**
 * @var \Closure                     $loadRouter
 *
 * @param \Phalcon\Di\FactoryDefault $di
 * @param \Phalcon\Mvc\Router\Group  $group
 *
 * @return \Phalcon\Mvc\Router\Group
 */
$loadRouter = function (
    \Phalcon\Di\FactoryDefault $di,
    \Phalcon\Mvc\Router\Group $router,
    \Bavix\Slice\Slice $slice) {

    $path = $slice->getRequired('path');
    $data = $slice->getRequired('data');

    require_once $path;

    return $router;
};

$loadRouter->bindTo($this);
$modules = $this->app()->getModules();
//$router->setDefaultModule(key($modules));

foreach ($modules as $prefix => $data)
{
    $directory = dirname($data['path']);
    $path = $directory . '/config/router.php';

    if (!file_exists($path))
    {
        throw new \Bavix\Exceptions\NotFound\Path('File `' . $path . '` not found');
    }

    $group = new \Phalcon\Mvc\Router\Group();
    $group->setPrefix('/' . $prefix);
    $group->setPaths([
        'module'    => $prefix,
        'namespace' => $data['namespace']
    ]);

    $loadRouter($di, $group, new \Bavix\Slice\Slice([
        'path' => $path,
        'data' => $data
    ]));

    $router->mount($group);

    // twig
    $this->getLoader()->addPath(
        $directory . '/views',
        preg_replace('~\W+~', '', $prefix)
    );
    // /twig
}

unset($group, $prefix, $data);
require_once $this->root() . 'config/router.php';

$router->handle();

return $router;
