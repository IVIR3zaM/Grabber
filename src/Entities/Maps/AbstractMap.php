<?php
namespace IVIR3aM\Grabber\Entities\Maps;

use IVIR3aM\Grabber\Entities\Exception;
use IVIR3aM\Grabber\Entities\SpecificationableTrait;

/**
 * Class AbstractMap
 * @package IVIR3aM\Grabber\Entities
 */
abstract class AbstractMap implements \Countable
{
    use SpecificationableTrait;

    protected $identifier;

    public function setIdentifier(string $name) : AbstractMap
    {
        if (!$this->getSpecification()->getField($name)) {
            throw new Exception(sprintf('Invalid Field name as an Identifier "%s"', $name));
        }
        $this->identifier = $name;
        return $this;
    }

    public function getIdentifier() : string
    {
        if (is_null($this->identifier)) {
            throw new Exception('Identifier not specified');
        }
        return $this->identifier;
    }

    public function getFieldMap(string $name)
    {
        $maps = $this->getFieldValue($name);
        if (empty($maps)) {
            $maps = [];
        }
        return $maps;
    }

    public function unsetFieldMap(string $name) : bool
    {
        if ($this->identifier && $this->identifier == $name) {
            return false;
        }
        if (isset($this->items[$name])) {
            unset($this->items[$name]);
        }
        return true;
    }

    public function __set(string $name, array $settings) : AbstractMap
    {
        return $this->setFieldMap($name, $settings);
    }

    public function __get(string $name)
    {
        return $this->getFieldMap($name);
    }

    public function getMaps() : array
    {
        $maps = [];
        foreach (array_keys($this->getSpecification()->getFields()) as $name) {
            $maps[$name] = $this->getFieldMap($name);
        }
        return $maps;
    }

    public function count() : int
    {
        return count($this->getMaps());
    }

    /**
     * @param string $name
     * @param array $settings
     * @throws Exception
     * @return AbstractMap
     */
    abstract public function setFieldMap(string $name, array $settings) : AbstractMap;
}