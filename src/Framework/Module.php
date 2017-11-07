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
        $module = $this;

        /**
         * Setting up the view component
         */
        $di->setShared('view', function () use ($module) {

            /**
             * @var $this \Phalcon\Di\FactoryDefault
             * @var $configure Config
             */
            $configure = $this->getConfigure();

            $view = new View();
            $view->setDI($this);
            $view->setViewsDir($module->moduleDir() . '/views');

            $view->registerEngines([
                '.volt' => function ($view) use ($configure) {
                    $volt = new View\Engine\Volt($view, $this);

                    $volt->setOptions([
                        'compiledPath' => $configure->application->cacheDir,
                        'compiledSeparator' => '_'
                    ]);

                    return $volt;
                },

                '.phtml' => View\Engine\Php::class

            ]);

            return $view;
        });


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
