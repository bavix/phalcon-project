<?php

namespace Framework;

use Phalcon\Mvc\Dispatcher;

class ControllerBase extends \Phalcon\Mvc\Controller
{

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $middleware;

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        return $this->builder;
    }

    /**
     * @return array|string[]
     */
    protected function middleware(): array
    {
       if ($this->middleware === null)
       {
           return $this->builder->app()->middleware();
       }

       return $this->middleware;
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

        foreach ($this->middleware() as $middleware)
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
