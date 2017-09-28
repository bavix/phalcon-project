<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

class Controller extends \Phalcon\Mvc\Controller
{

    /**
     * @var Builder
     */
    protected $builder;

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->builder = $this->di->get('builder');
    }

}
