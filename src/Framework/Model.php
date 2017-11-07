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

    public function getSource(): string
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
        $this->observer('creating', $data, $whiteList);
        $result = parent::create($data, $whiteList);
        $this->observer('created', $data, $whiteList);

        return $result;
    }

    public function update($data = null, $whiteList = null)
    {
        $this->observer('updating', $data, $whiteList);
        $result = parent::update($data, $whiteList);
        $this->observer('updated', $data, $whiteList);

        return $result;
    }

    public function save($data = null, $whiteList = null)
    {
        $creating = isset($this->id);
        $this->observer($creating ? 'updating' : 'creating', $data, $whiteList);
        $result = parent::save($data, $whiteList);
        $this->observer($creating ? 'updated' : 'created', $data, $whiteList);

        return $result;
    }

    public function delete()
    {
        $this->observer('deleting');
        $result = parent::delete();
        $this->observer('deleted');

        return $result;
    }

}
