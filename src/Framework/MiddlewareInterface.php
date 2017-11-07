<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

interface MiddlewareInterface
{
    /**
     * @param Dispatcher     $dispatcher
     * @param ControllerBase $controller
     *
     * @return mixed
     */
    public function next(Dispatcher $dispatcher, ControllerBase $controller);
}
