<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Class ValueInterface
 * @package IVIR3aM\Grabber\Entities
 */
interface ValueInterface
{
    public function __construct(SpecificationInterface $specification);

    public function setSpecification(SpecificationInterface $specification) : ValueInterface;

    public function getSpecification() : SpecificationInterface;

    public function setValue(string $name, $value) : ValueInterface;

    public function getValue(string $name);

    public function getValues() : array;

    public function __get(string $name);

    public function __set(string $name, $value) : ValueInterface;
}