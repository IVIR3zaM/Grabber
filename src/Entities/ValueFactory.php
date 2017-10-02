<?php
namespace IVIR3aM\Grabber\Entities;

class ValueFactory extends AbstractValueFactory
{
    public function makeValue() : AbstractValue
    {
        return new Value($this->getSpecification());
    }
}