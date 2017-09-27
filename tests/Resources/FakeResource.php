<?php
namespace IVIR3aM\Grabber\Tests\Resources;

use IVIR3aM\Grabber\Entities\MapInterface;
use IVIR3aM\Grabber\Entities\ValueInterface;
use IVIR3aM\Grabber\Resources\Resource;
use IVIR3aM\Grabber\Resources\ResourceInterface;

class FakeResource extends Resource
{
    protected $isConnected = false;

    public function connect() : ResourceInterface
    {
        $this->isConnected = true;
        return $this;
    }

    public function disconnect() : ResourceInterface
    {
        $this->isConnected = false;
        return $this;
    }

    public function isConnected() : bool
    {
        return $this->isConnected;
    }

    public function fetch(MapInterface $entityMap, string $identifier) : ValueInterface
    {
        return null;
    }

    public function push(MapInterface $entityMap, ValueInterface $entityValue) : bool
    {
        return true;
    }
}