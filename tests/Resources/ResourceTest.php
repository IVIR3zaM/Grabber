<?php
namespace IVIR3aM\Grabber\Tests\Resources;

use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    /**
     * @var FakeResource
     */
    private $resource;

    public function setUp()
    {
        $this->resource = new FakeResource();
    }

    public function testSettings()
    {
        $this->resource->setSettings(['test' => 1]);
        $settings = $this->resource->getSettings();

        $this->assertArrayHasKey('test', $settings);
        $this->assertCount(1, $settings);
        $this->assertSame(1, $settings['test']);

        $this->resource->setSetting('foo', 'bar');
        $settings = $this->resource->getSettings();

        $this->assertArrayHasKey('foo', $settings);
        $this->assertCount(2, $settings);
        $this->assertSame('bar', $this->resource->getSetting('foo'));

        $this->resource->unsetSetting('test');
        $this->assertSame(1, $this->resource->count());

        $this->assertSame(null, $this->resource->getSetting('some'));
    }

    public function testConstructionDestruction()
    {
        $this->resource = new FakeResource(['foo' => 'bar']);

        $this->assertSame('bar', $this->resource->getSetting('foo'));
    }

    /**
     * @expectedException TypeError
     */
    public function testInvalidSettingName()
    {
        $this->resource->setSetting([], 123);
    }
}