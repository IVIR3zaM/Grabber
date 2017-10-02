<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Class AbstractValue
 * @package IVIR3aM\Grabber\Entities
 */
abstract class AbstractValue implements \Countable
{
    use SpecificationableTrait;

    public function __set(string $name, $value) : AbstractValue
    {
        return $this->setValue($name, $value);
    }

    public function __get(string $name)
    {
        return $this->getValue($name);
    }

    abstract public function setValue(string $name, $value) : AbstractValue;

    abstract public function getValue(string $name);

    abstract public function getValues() : array;
}