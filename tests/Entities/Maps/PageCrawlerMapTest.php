<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Maps\Web\PageCrawlerMap;
use IVIR3aM\Grabber\Entities\Specification;
use PHPUnit\Framework\TestCase;

class PageCrawlerMapTest extends TestCase
{
    /**
     * @var PageCrawlerMap
     */
    private $map;

    public function setUp()
    {
        $this->map = new PageCrawlerMap(new Specification());
    }

    public function testSetSetting()
    {
        $this->map->getSpecification()->addText('text');
        $this->assertCount(1, $this->map);

        $map = [
            'filter' => 'h2 > a',
            'target' => 'attribute',
            'attribute' => 'href',
        ];
        $this->map->setFieldMap('text', $map);
        $this->assertSame($map, $this->map->getFieldMap('text'));
        $this->assertSame($map, $this->map->text);
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testSetInvalidMapField()
    {
        $this->map->setFieldMap('text', [
            'filter' => 'h2 > a',
            'target' => 'text',
        ]);
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testSetInvalidMapFilter()
    {
        $this->map->setFieldMap('text', [
            'target' => 'h2 > a',
        ]);
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testSetInvalidMapTarget()
    {
        $this->map->setFieldMap('text', [
            'filter' => 'h2 > a',
        ]);
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testSetInvalidMapAttribute()
    {
        $this->map->setFieldMap('text', [
            'filter' => 'h2 > a',
            'target' => 'attribute',
        ]);
    }
}