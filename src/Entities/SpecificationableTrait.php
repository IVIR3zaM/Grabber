<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Class SpecificationableTrait
 * @package IVIR3aM\Grabber\Entities
 */
trait SpecificationableTrait
{
    /**
     * @var SpecificationInterface
     */
    protected $specification;

    protected $items = [];

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

    protected function getFieldValue(string $name)
    {
        if (isset($this->items[$name])) {
            return $this->items[$name];
        }
        try {
            $type = $this->getFieldType($name);
            if (SpecificationInterface::ENTITY == $type) {
                $class = get_called_class();
                $this->items[$name] = new $class($this->getSpecification()->getField($name));
                return $this->items[$name];
            }
        } catch (Exception $e) {
        }
    }

    public function __construct(SpecificationInterface $specification)
    {
        $this->setSpecification($specification);
    }

    public function setSpecification(SpecificationInterface $specification) : self
    {
        $this->specification = $specification;
        return $this;
    }

    public function getSpecification() : SpecificationInterface
    {
        return $this->specification;
    }
}