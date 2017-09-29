<?php

namespace Middleware;

use Framework\Controller;
use Framework\MiddlewareInterface;
use Phalcon\Mvc\Dispatcher;

class NoIndexMiddleware implements MiddlewareInterface
{

    public function next(Dispatcher $dispatcher, Controller $controller)
    {
        $uri = $controller->request->getURI();

        if (preg_match('~^/index\.php~', $uri))
        {
            $url = \mb_substr($controller->request->getURI(), 10);

            if (empty($url))
            {
                $url = '/';
            }

            return $controller->response->redirect(
                $url,
                true
            );
        }

        return true;
    }

}
