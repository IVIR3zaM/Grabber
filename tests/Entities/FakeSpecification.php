<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Specification;
use IVIR3aM\Grabber\Entities\SpecificationInterface;

class FakeSpecification extends Specification
{
    public function addUnknown(string $name) : SpecificationInterface
    {
        $this->fields[$name] = 'Unknown';
        return $this;
    }
}