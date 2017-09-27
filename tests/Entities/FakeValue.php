<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Value;

class FakeValue extends Value
{
    protected function setIntegerValue(string $name, int $value)
    {
        $this->values[$name] = $value;
    }
}