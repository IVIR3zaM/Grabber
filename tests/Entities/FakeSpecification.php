<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Specification;
use IVIR3aM\Grabber\Entities\SpecificationInterface;

class FakeSpecification extends Specification implements FakeSpecificationInterface
{
    public function addInteger(string $name) : SpecificationInterface
    {
        $this->fields[$name] = FakeSpecificationInterface::INTEGER;
        return $this;
    }
}