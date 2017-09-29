<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

interface MiddlewareInterface
{
    /**
     * @param Dispatcher $dispatcher
     * @param Controller $controller
     *
     * @return mixed
     */
    public function next(Dispatcher $dispatcher, Controller $controller);
}
