<?php
namespace IVIR3aM\Grabber\Tests;

use IVIR3aM\Grabber\EntityMap;
use IVIR3aM\Grabber\EntityValue;
use IVIR3aM\Grabber\Resource;

class ResourceFake extends Resource
{
    public function connect() : bool
    {
        return true;
    }
    public function disconnect() : bool
    {
        return true;
    }

    public function fetch(EntityMap $entityMap, string $identifier) : EntityValue
    {
        return new EntityValue();
    }

    public function push(EntityMap $entityMap, EntityValue $entityValue) : bool
    {
        return true;
    }
}