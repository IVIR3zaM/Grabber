<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Class Specification
 * @package IVIR3aM\Grabber\Entities
 */
class Specification implements SpecificationInterface
{
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
     * @return SpecificationInterface
     * @throws Exception
     */
    protected function addField(string $name, string $type) : SpecificationInterface
    {
        $this->testFieldName($name);
        $this->fields[$name] = $type;
        return $this;
    }

    /**
     * @param string $name
     * @return SpecificationInterface
     */
    public function removeField(string $name) : SpecificationInterface
    {
        if(isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }
        return $this;
    }

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addText(string $name) : SpecificationInterface
    {
        return $this->addField($name, static::TEXT);
    }

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addNumber(string $name) : SpecificationInterface
    {
        return $this->addField($name, static::NUMBER);
    }

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addBoolean(string $name) : SpecificationInterface
    {
        return $this->addField($name, static::BOOLEAN);
    }

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addFile(string $name) : SpecificationInterface
    {
        return $this->addField($name, static::FILE);
    }

    /**
     * @param string $name
     * @param SpecificationInterface $entity
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addEntity(string $name, SpecificationInterface $entity) : SpecificationInterface
    {
        $this->testFieldName($name);
        $this->fields[$name] = $entity;
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getField(string $name)
    {
        if (isset($this->fields[$name])) {
            return $this->fields[$name];
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->getField($name);
    }

    /**
     * @return array
     */
    public function getFields() : array
    {
        $fields = [];
        foreach ($this->fields as $key => $value) {
            if (is_a($value, SpecificationInterface::class)) {
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
        return count($this->getFields());
    }
}