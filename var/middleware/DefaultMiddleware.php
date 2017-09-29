<?php

namespace Middleware;

use Framework\Controller;
use Framework\Middleware;
use Phalcon\Mvc\Dispatcher;

class DefaultMiddleware implements Middleware
{

    public function handle(Dispatcher $dispatcher, Controller $controller)
    {
        $uri = $controller->request->getURI();

        if (preg_match('~/index(/index)?$~', $uri))
        {
            return $controller->response->redirect('/', true);
        }

        return true;
    }

}
