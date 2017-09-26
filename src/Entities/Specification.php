<?php
namespace IVIR3aM\Grabber\Entities;

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

    protected $fields = [];

    /**
     * @param string $name
     * @param string $type
     * @return Specification
     * @throws Exception
     */
    protected function addField(string $name, string $type) : self
    {
        if (isset($this->fields[$name])) {
            throw new Exception(sprintf('Repeated Field name "%s"', $name));
        }
        return $this->setField($name, $type);
    }

    /**
     * @param string $name
     * @param string $type
     * @return Specification
     */
    protected function setField(string $name, string $type) : self
    {
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
     * @return array
     */
    public function getFields() : array
    {
        return $this->fields;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->fields);
    }
}