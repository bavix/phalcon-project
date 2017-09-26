<?php

namespace Framework;

use Phalcon\Di\FactoryDefault;

class Builder
{

    /**
     * @var array
     */
    protected $rows = [];

    /**
     * @var string
     */
    protected $root;

    /**
     * Builder constructor.
     *
     * @param string $root
     */
    public function __construct(string $root)
    {
        $this->root = rtrim($root, '\\/') . '/';
    }

    /**
     * @return string
     */
    public function root(): string
    {
        return $this->root;
    }

    public function app(): App
    {
        return $this->once(__FUNCTION__, function () {
            return new App($this);
        });
    }

    public function urlPath()
    {
        return $this->once(__FUNCTION__, function () {
            $uri = $this->request()->getServer('REQUEST_URI');

            return \parse_url($uri, PHP_URL_PATH);
        });
    }

    public function request()
    {
        return $this->once(__FUNCTION__, function () {
            return $this->di()->getRequest();
        });
    }

    public function config()
    {
        return $this->once(__FUNCTION__, function () {
            return $this->di()->getConfig();
        });
    }

    /**
     * @return FactoryDefault
     */
    public function di(): FactoryDefault
    {
        return $this->once(__FUNCTION__, function () {
            return new FactoryDefault();
        }, function () {

            if (PHP_SAPI !== 'cli')
            {
                $this->initd('router');
            }

            $this->initd('services');

            $this->config();

            $this->initd('loader');

        });
    }

    // protected

    protected function initd($__serviceName)
    {
        return $this->once($__serviceName, function () use ($__serviceName) {

            extract($this->rows, EXTR_OVERWRITE);

            return require $this->root() . 'initd/' . $__serviceName . '.php';
        });
    }

    protected function once($name, callable $callable, callable $last = null)
    {
        if (!isset($this->rows[$name]))
        {
            $this->rows[$name] = $callable();

            if (null !== $last)
            {
                $last();
            }
        }

        return $this->rows[$name];
    }

}
