<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Class AbstractValueFactory
 * @package IVIR3aM\Grabber\Entities
 */
abstract class AbstractValueFactory
{
    use SpecificationableTrait;

    abstract public function makeValue() : AbstractValue;
}