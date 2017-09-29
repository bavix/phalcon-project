<?php

namespace Framework;

class Model extends \Phalcon\Mvc\Model
{

    /**
     * @var array
     */
    protected $events = [];

    protected function initEvent($name)
    {
        if (!($di = $this->getDI()))
        {
            return;
        }

        if (empty($this->events[$name]))
        {
            return;
        }

        $event = $this->events[$name];

        if (\is_string($event))
        {
            $event = [$event, 'handle'];
        }

        $event($this->getDI(), $this);
    }

    public function update($data = null, $whiteList = null)
    {
        $function = \ucfirst(__FUNCTION__);

        $this->initEvent('before' . $function);
        $result = parent::update($data, $whiteList);
        $this->initEvent('after' . $function);

        return $result;
    }

    public function create($data = null, $whiteList = null)
    {
        $function = \ucfirst(__FUNCTION__);

        $this->initEvent('before' . $function);
        $result = parent::create($data, $whiteList);
        $this->initEvent('after' . $function);

        return $result;
    }

    public function delete()
    {
        $function = \ucfirst(__FUNCTION__);

        $this->initEvent('before' . $function);
        $result = parent::delete();
        $this->initEvent('after' . $function);

        return $result;
    }

}
