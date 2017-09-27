<?php
namespace IVIR3aM\Grabber\Entities;

class Value implements ValueInterface, \Countable
{
    /**
     * @var SpecificationInterface
     */
    protected $specification;

    protected $values = [];
    
    public function __construct(SpecificationInterface $specification)
    {
        $this->setSpecification($specification);
    }

    public function setSpecification(SpecificationInterface $specification) : ValueInterface
    {
        $this->specification = $specification;
        return $this;
    }

    public function getSpecification() : SpecificationInterface
    {
        return $this->specification;
    }

    protected function getFieldType(string $name) : string
    {
        $type = $this->getSpecification()->getField($name);
        if (is_object($type) && is_a($type, SpecificationInterface::class)) {
            return SpecificationInterface::ENTITY;
        }
        if (is_null($type)) {
            throw new Exception(sprintf('Field "%s" Not Found', $name));
        }
        return $type;
    }

    protected function getFieldFunction(string $name) : string
    {
        $function = 'set' . $this->getFieldType($name) . 'Value';
        if (!method_exists($this, $function)) {
            throw new Exception(sprintf('Unknown Field Type "%s"', $name));
        }
        return $function;
    }

    public function setValue(string $name, $value) : ValueInterface
    {
        $function = $this->getFieldFunction($name);
        $this->$function($name, $value);
        return $this;
    }

    public function getValue(string $name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }
        try {
            $type = $this->getFieldType($name);
            if (SpecificationInterface::ENTITY == $type) {
                $this->values[$name] = new self($this->getSpecification()->getField($name));
                return $this->values[$name];
            }
        } catch (Exception $e){}
    }

    public function __set(string $name, $value) : ValueInterface
    {
        return $this->setValue($name, $value);
    }

    public function __get(string $name)
    {
        return $this->getValue($name);
    }

    protected function setTextValue(string $name, string $value)
    {
        $this->values[$name] = $value;
    }

    protected function setNumberValue(string $name, float $value)
    {
        if ($value == intval($value)) {
            $value = intval($value);
        }
        $this->values[$name] = $value;
    }
    
    protected function setBooleanValue(string $name, bool $value)
    {
        $this->values[$name] = $value;
    }

    protected function setFileValue(string $name, $value)
    {
        if (false === is_resource($value)) {
            throw new Exception(sprintf('Invalid value type for "%s" filed, stream resource required', $name));
        }
        if ('stream' != get_resource_type($value)) {
            throw new Exception(sprintf('Invalid resource type "%s" filed, stream resource required', $name));
        }
        $this->values[$name] = $value;
    }

    protected function setEntityValue(string $name, ValueInterface $value)
    {
        $this->values[$name] = $value;
    }

    public function getValues() : array
    {
        $list = [];
        foreach ($this->getSpecification()->getFields() as $name => $type) {
            $value = $this->getValue($name);
            if (is_object($value) && is_a($value, ValueInterface::class)) {
                $value = $value->getValues();
            }
            $list[$name] = $value;
        }
        return $list;
    }

    public function count() : int
    {
        return count($this->getSpecification()->getFields());
    }
}