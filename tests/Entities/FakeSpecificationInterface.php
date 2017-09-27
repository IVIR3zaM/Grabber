<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\SpecificationInterface;

interface FakeSpecificationInterface extends SpecificationInterface
{
    const INTEGER = 'Integer';

    public function addInteger(string $name) : SpecificationInterface;
}