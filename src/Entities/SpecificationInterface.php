<?php
namespace IVIR3aM\Grabber\Entities;

/**
 * Interface SpecificationInterface
 * @package IVIR3aM\Grabber\Entities
 */
interface SpecificationInterface extends \Countable
{
    const TEXT = 'Text';
    const NUMBER = 'Number';
    const BOOLEAN = 'Boolean';
    const FILE = 'File';
    const ENTITY = 'Entity';

    /**
     * @param string $name
     * @return SpecificationInterface
     */
    public function removeField(string $name) : SpecificationInterface;

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addText(string $name) : SpecificationInterface;

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addNumber(string $name) : SpecificationInterface;

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addBoolean(string $name) : SpecificationInterface;

    /**
     * @param string $name
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addFile(string $name) : SpecificationInterface;

    /**
     * @param string $name
     * @param SpecificationInterface $entity
     * @return SpecificationInterface
     * @throws Exception
     */
    public function addEntity(string $name, SpecificationInterface $entity) : SpecificationInterface;

    /**
     * @param string $name
     * @return mixed
     */
    public function getField(string $name);

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name);

    /**
     * @return array
     */
    public function getFields() : array;
}