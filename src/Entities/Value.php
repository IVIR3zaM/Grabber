<?php
namespace IVIR3aM\Grabber\Entities;

class Value extends AbstractValue
{
    protected function getFieldFunction(string $name) : string
    {
        $function = 'set' . $this->getFieldType($name) . 'Value';
        if (!method_exists($this, $function)) {
            throw new Exception(sprintf('Unknown Field Type "%s"', $name));
        }
        return $function;
    }

    public function setValue(string $name, $value) : AbstractValue
    {
        $function = $this->getFieldFunction($name);
        $this->$function($name, $value);
        return $this;
    }

    public function getValue(string $name)
    {
        return $this->getFieldValue($name);
    }

    protected function setTextValue(string $name, string $value)
    {
        $this->items[$name] = $value;
    }

    protected function setNumberValue(string $name, float $value)
    {
        if ($value == intval($value)) {
            $value = intval($value);
        }
        $this->items[$name] = $value;
    }
    
    protected function setBooleanValue(string $name, bool $value)
    {
        $this->items[$name] = $value;
    }

    protected function setFileValue(string $name, $value)
    {
        if (false === is_resource($value)) {
            throw new Exception(sprintf('Invalid value type for "%s" filed, stream resource required', $name));
        }
        if ('stream' != get_resource_type($value)) {
            throw new Exception(sprintf('Invalid resource type "%s" filed, stream resource required', $name));
        }
        $this->items[$name] = $value;
    }

    protected function setEntityValue(string $name, AbstractValue $value)
    {
        $this->items[$name] = $value;
    }

    public function getValues() : array
    {
        $list = [];
        foreach (array_keys($this->getSpecification()->getFields()) as $name) {
            $value = $this->getValue($name);
            if (is_object($value) && is_a($value, AbstractValue::class)) {
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