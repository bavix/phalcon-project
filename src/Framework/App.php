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
     * Terminate application
     */
    public function terminate()
    {
        $response = $this->handle($this->builder->urlPath());
        echo $response->getContent();
        die;
    }

}
