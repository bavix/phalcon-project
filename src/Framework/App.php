<?php

namespace Framework;

use Phalcon\Mvc\Application;

class App extends Application
{

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $queues;

    /**
     * App constructor.
     *
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        parent::__construct($builder->di());
        $this->builder = $builder;
    }

    /**
     * @param string $class
     * @param mixed  $data
     *
     * @return $this
     */
    public function queue($class, $data)
    {
        $this->queues[] = [$class, $data];

        return $this;
    }

    /**
     * Terminate application
     */
    public function terminate()
    {
        $response = $this->handle($this->builder->urlPath());
        echo $response->getContent();

        if (function_exists('\fastcgi_finish_request'))
        {
            \fastcgi_finish_request();

            foreach ($this->queues as list($queue, $data))
            {
                $this->startQueue($queue, $data);
            }
        }

        die;
    }

    /**
     * @param $class
     * @param $data
     *
     * @return mixed
     */
    protected function startQueue($class, $data)
    {
        if (\is_string($class) && \class_exists($class))
        {
            $object = new $class();

            if (!($object instanceof Observer))
            {
                return null;
            }

            $class  = [$object, 'handle'];
        }

        return $class($this->builder, $data);
    }

}
