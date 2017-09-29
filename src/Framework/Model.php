<?php

namespace Framework;

use Doctrine\Common\Inflector\Inflector;

class Model extends \Phalcon\Mvc\Model
{

    /**
     * @var string
     */
    protected $_observerClass;

    /**
     * @var Observer
     */
    private $_observerObject;

    /**
     * @var string
     */
    protected $_tableName;

    /**
     * @param $name
     * @param $data
     * @param $whiteList
     *
     * @return void
     */
    protected function observer($name, $data = null, $whiteList = null)
    {

        $class = $this->_observerClass;

        if (!$class)
        {
            return;
        }

        if (!$this->_observerObject)
        {
            global $builder;
            $this->_observerObject = new $class($this, $builder->di());
        }

        $object = $this->_observerObject;

        if (\method_exists($object, $name))
        {
            $object->$name($data, $whiteList);
        }

    }

    public function getSource()
    {
        if (!$this->_tableName)
        {
            $ref   = new \ReflectionClass(static::class);
            $table = $ref->getShortName();
            $table = lcfirst($table);

            $this->_tableName = Inflector::pluralize($table);
        }

        return $this->_tableName;
    }

    public function create($data = null, $whiteList = null)
    {
        $this->observer(__FUNCTION__, $data, $whiteList);

        return parent::create($data, $whiteList);
    }

    public function update($data = null, $whiteList = null)
    {
        $this->observer(__FUNCTION__, $data, $whiteList);

        return parent::update($data, $whiteList);
    }

    public function save($data = null, $whiteList = null)
    {
        $this->observer(isset($this->id) ? 'update' : 'create', $data, $whiteList);

        return parent::save($data, $whiteList);
    }

    public function delete()
    {
        $this->observer(__FUNCTION__);

        return parent::delete();
    }

}
