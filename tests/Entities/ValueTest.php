<?php
namespace IVIR3aM\Grabber\Tests\Entities;

use IVIR3aM\Grabber\Entities\Value;
use IVIR3aM\Grabber\Entities\Specification;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    /**
     * @var Value
     */
    private $value;

    public function setUp()
    {
        $this->value = new Value(new Specification());
    }
    
    public function testSetGetValues()
    {
        $list = [];
        $this->value->getSpecification()->addText('text');
        $this->assertCount(1, $this->value);

        $this->value->text = 'Lorem Ipsum';
        $this->assertSame('Lorem Ipsum', $this->value->text);
        $this->assertSame('Lorem Ipsum', $this->value->getValue('text'));

        $list['text'] = 'Lorem Ipsum';
        $this->assertSame($list, $this->value->getValues());

        $this->value->getSpecification()->addNumber('number');
        $this->assertCount(2, $this->value);

        $this->value->number = '123';
        $this->assertSame(123, $this->value->number);

        $list['number'] = 123;
        $this->assertSame($list, $this->value->getValues());

        $this->value->getSpecification()->addBoolean('bool');
        $this->assertCount(3, $this->value);

        $this->value->bool = '1';
        $this->assertTrue($this->value->bool);

        $list['bool'] = true;
        $this->assertSame($list, $this->value->getValues());

        $this->value->bool = '0';
        $this->assertFalse($this->value->bool);

        $list['bool'] = false;
        $this->assertSame($list, $this->value->getValues());

        $this->value->getSpecification()->addFile('file');
        $this->assertCount(4, $this->value);

        $file = tempnam(sys_get_temp_dir(), 'test');
        $resource = fopen($file, 'w+');
        $this->value->file = $resource;
        $this->assertSame($resource, $this->value->file);

        $list['file'] = $resource;
        $this->assertSame($list, $this->value->getValues());
        unlink($file);

        $spec = new Specification();
        $this->value->getSpecification()->addEntity('entity', $spec);
        $this->assertCount(5, $this->value);

        $spec->addText('test');
        $this->value->entity->test = 'Lorem Ipsum';
        $this->assertSame('Lorem Ipsum', $this->value->entity->test);

        $list['entity']['test'] = 'Lorem Ipsum';
        $this->assertSame($list, $this->value->getValues());

        $this->value->setValue('entity', new Value($spec));
        $this->value->getValue('entity')->setValue('test', 'tested');
        $this->assertSame('tested', $this->value->entity->test);

        $list['entity']['test'] = 'tested';
        $this->assertSame($list, $this->value->getValues());

        $this->assertNull($this->value->getValue('test'));
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testInvalidFileValue()
    {
        $this->value->getSpecification()->addFile('test');
        $this->value->setValue('test', 'test');
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testInvalidFileStream()
    {
        $this->value->getSpecification()->addFile('test');
        $this->value->setValue('test', imagecreatetruecolor(1,1));
    }

    /**
     * @expectedException \IVIR3aM\Grabber\Entities\Exception
     */
    public function testUnknownFieldType()
    {
        $this->value->setSpecification(new FakeSpecification());
        $this->value->getSpecification()->addInteger('int');
        $this->value->setValue('int', 1);
    }

    public function testExtensionality()
    {
        $this->value = new FakeValue(new FakeSpecification());
        $this->value->getSpecification()->addInteger('int');
        $this->assertCount(1, $this->value);

        $this->value->setValue('int', 1.23);
        $this->assertSame(1, $this->value->int);
    }
}