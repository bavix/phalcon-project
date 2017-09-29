<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

class Controller extends \Phalcon\Mvc\Controller
{

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        return $this->builder;
    }

    /**
     * @param Dispatcher $dispatcher
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->builder = $this->di->get('builder');

        foreach ($this->builder->app()->middleware() as $middleware)
        {
            $object = new $middleware();

            if (!($object instanceof MiddlewareInterface))
            {
                throw new \RuntimeException('Middleware `' . $middleware . '` not found');
            }

            $result = $object->next($dispatcher, $this);

            if (!$result || !\is_bool($result))
            {
                return false;
            }
        }

        return true;
    }

}
