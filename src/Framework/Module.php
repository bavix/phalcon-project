<?php

namespace Framework;

use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

abstract
class Module implements ModuleDefinitionInterface
{

    /**
     * @var Builder
     */
    public $builder;

    /**
     * Module constructor.
     */
    public function __construct()
    {
        global $builder;
        $this->builder = $builder;
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            $this->namespace() => $this->moduleDir() . '/src'
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * @var $builder Builder
         * @var $view View
         */
        $builder = $di['builder'];
        $view = $di['view'];

        $builder->getLoader()->addPath(
            $this->moduleDir() . '/views/',
            '__main__'
        );

        $view->setViewsDir($this->moduleDir() . '/views/');
    }

    /**
     * @return string
     */
    abstract public function namespace(): string;

    /**
     * @return string
     */
    abstract public function moduleDir(): string;

}
