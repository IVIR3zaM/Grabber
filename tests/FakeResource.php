<?php
namespace IVIR3aM\Grabber\Tests;

use IVIR3aM\Grabber\Entities\Map as EntityMap;
use IVIR3aM\Grabber\Entities\Value as EntityValue;
use IVIR3aM\Grabber\Resource;

class FakeResource extends Resource
{
    protected $isConnected = false;

    public function connect() : Resource
    {
        $this->isConnected = true;
        return $this;
    }

    public function disconnect() : Resource
    {
        $this->isConnected = false;
        return $this;
    }

    public function isConnected() : bool
    {
        return $this->isConnected;
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