<?php
namespace IVIR3aM\Grabber\Tests;

use IVIR3aM\Grabber\Logger\Closure;
use PHPUnit_Framework_TestCase;

class ResourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceFake
     */
    private $resource;

    public function setUp()
    {
        $this->resource = new ResourceFake();
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
        $this->assertSame('bar', $settings['foo']);

        $this->resource->unsetSetting('test');
        $settings = $this->resource->getSettings();

        $this->assertCount(1, $settings);
    }
}