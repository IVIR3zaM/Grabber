<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Specification;
use IVIR3aM\Grabber\Tests\Entities\Maps\FakeMap;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    /**
     * @var FakeMap
     */
    private $map;

    public function setUp()
    {
        $this->map = new FakeMap(new Specification());
    }

    public function testSetSetting()
    {
        $this->map->getSpecification()->addText('text');
        $this->assertCount(1, $this->map);

        $map = [
            'target' => 'someText',
        ];
        $this->map->setFieldMap('text', $map);
        $this->assertSame($map, $this->map->getFieldMap('text'));
        $this->assertSame($map, $this->map->text);
        
        $this->map->setIdentifier('text');
        $this->assertFalse($this->map->unsetFieldMap('text'));
        $this->assertSame('text', $this->map->getIdentifier());

        $this->map->getSpecification()->addText('test');
        $this->assertCount(2, $this->map);

        $this->map->test = $map;
        $this->assertTrue($this->map->unsetFieldMap('test'));

        $this->map->setFieldMap('test', $map);
        $this->map->setIdentifier('test');
        $this->assertSame('test', $this->map->getIdentifier());
        $this->assertTrue($this->map->unsetFieldMap('text'));
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testSetInvalidIdentifier()
    {
        $this->map->setIdentifier('text');
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testGetUndefinedIdentifier()
    {
        $this->map->getIdentifier();
    }
}