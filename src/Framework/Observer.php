<?php

namespace Framework;

use Phalcon\DiInterface;

abstract class Observer
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * Observer constructor.
     *
     * @param Model       $model
     * @param DiInterface $di
     */
    public function __construct(Model $model, DiInterface $di)
    {
        $this->model = $model;
        $this->di    = $di;
    }

}
