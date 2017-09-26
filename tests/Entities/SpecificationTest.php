<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Specification;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    /**
     * @var Specification
     */
    private $specification;

    public function setUp()
    {
        $this->specification = new Specification();
    }
    
    public function testAddRemoveItems()
    {
        $this->specification->addText('text');
        $this->assertCount(1, $this->specification);
        $this->assertSame(['text' => Specification::TEXT], $this->specification->getFields());

        $this->specification->addNumber('number');
        $this->assertCount(2, $this->specification);
        $this->assertSame(['text' => Specification::TEXT, 'number' => Specification::NUMBER], $this->specification->getFields());

        $this->specification->addBoolean('bool');
        $this->assertCount(3, $this->specification);
        $this->assertSame(['text' => Specification::TEXT, 'number' => Specification::NUMBER, 'bool' => Specification::BOOLEAN], $this->specification->getFields());

        $this->specification->removeField('text');
        $this->assertCount(2, $this->specification);
        $this->assertSame(['number' => Specification::NUMBER, 'bool' => Specification::BOOLEAN], $this->specification->getFields());

        $this->specification->removeField('bool');
        $this->assertCount(1, $this->specification);
        $this->assertSame(['number' => Specification::NUMBER], $this->specification->getFields());

        $this->specification->removeField('number');
        $this->assertCount(0, $this->specification);
        $this->assertSame([], $this->specification->getFields());

        $this->specification->addFile('file');
        $this->assertCount(1, $this->specification);
        $this->assertSame(['file' => Specification::FILE], $this->specification->getFields());
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testDuplicatedFieldName()
    {
        $this->specification->addText('test');
        $this->specification->addFile('test');
    }
}