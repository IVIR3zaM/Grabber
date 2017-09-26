<?php
namespace IVIR3aM\Grabber\Entities;

use ReflectionClass;
/**
 * Class Specification
 * @package IVIR3aM\Grabber\Entities
 */
class Specification implements \Countable
{
    const TEXT = 'Text';
    const NUMBER = 'Number';
    const BOOLEAN = 'Boolean';
    const FILE = 'File';

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param string $name
     * @throws Exception
     */
    protected function testFieldName(string $name)
    {
        if (!preg_match('/^[a-z]+[a-z0-9]*$/i', $name)) {
            throw new Exception(sprintf('Invalid Field Name "%s"', $name));
        }
        if (isset($this->fields[$name])) {
            throw new Exception(sprintf('Repeated Field Name "%s"', $name));
        }
    }

    /**
     * @param string $name
     * @param string $type
     * @return Specification
     * @throws Exception
     */
    protected function addField(string $name, string $type) : self
    {
        $this->testFieldName($name);
        $this->fields[$name] = $type;
        return $this;
    }

    /**
     * @param string $name
     * @return Specification
     */
    public function removeField(string $name) : self
    {
        if(isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }
        return $this;
    }

    /**
     * @param string $name
     * @return Specification
     * @throws Exception
     */
    public function addText(string $name) : self
    {
        return $this->addField($name, static::TEXT);
    }

    /**
     * @param string $name
     * @return Specification
     * @throws Exception
     */
    public function addNumber(string $name) : self
    {
        return $this->addField($name, static::NUMBER);
    }

    /**
     * @param string $name
     * @return Specification
     * @throws Exception
     */
    public function addBoolean(string $name) : self
    {
        return $this->addField($name, static::BOOLEAN);
    }

    /**
     * @param string $name
     * @return Specification
     * @throws Exception
     */
    public function addFile(string $name) : self
    {
        return $this->addField($name, static::FILE);
    }

    /**
     * @param string $name
     * @param Specification $entity
     * @return Specification
     * @throws Exception
     */
    public function addEntity(string $name, Specification $entity) : self
    {
        $this->testFieldName($name);
        $this->fields[$name] = $entity;
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (isset($this->fields[$name])) {
            return $this->fields[$name];
        }
    }

    /**
     * @return array
     */
    public function getFields() : array
    {
        $fields = [];
        foreach ($this->fields as $key => $value) {
            if (is_a($value, Specification::class)) {
                $value = $value->getFields();
            }
            $fields[$key] = $value;
        }
        return $fields;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->fields);
    }
}