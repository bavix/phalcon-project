<?php

namespace Middleware;

use Framework\Controller;
use Framework\MiddlewareInterface;
use Phalcon\Mvc\Dispatcher;

class DefaultMiddleware implements MiddlewareInterface
{

    public function next(Dispatcher $dispatcher, Controller $controller)
    {
        $uri = $controller->request->getURI();

        if (preg_match('~/index(/index)?$~', $uri))
        {
            return $controller->response->redirect('/', true);
        }

        return true;
    }

}
