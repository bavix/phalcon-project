<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

interface Middleware
{
    /**
     * @param Dispatcher $dispatcher
     * @param Controller $controller
     *
     * @return mixed
     */
    public function handle(Dispatcher $dispatcher, Controller $controller);
}
