<?php
namespace IVIR3aM\Grabber\Tests\Resources;

use IVIR3aM\Grabber\Entities\AbstractValueFactory;
use IVIR3aM\Grabber\Entities\Maps\AbstractMap;
use IVIR3aM\Grabber\Entities\AbstractValue;
use IVIR3aM\Grabber\Resources\Exception;
use IVIR3aM\Grabber\Resources\AbstractResource;

class FakeResource extends AbstractResource
{
    public function fetch(AbstractMap $map, AbstractValueFactory $factory) : AbstractValue
    {
        throw new Exception('This is only a test');
    }

    public function push(AbstractMap $map, AbstractValue $entity) : bool
    {
        return false;
    }

    public function fetchAll(AbstractMap $map, AbstractValueFactory $factory) : array
    {
        throw new Exception('This is only a test');
    }

    public function pushAll(AbstractMap $map, array $entities) : bool
    {
        return false;
    }
}