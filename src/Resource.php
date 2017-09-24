<?php
namespace IVIR3aM\Grabber;

abstract class Resource
{
    /**
     * @var array
     */
    protected $settings = [];

    public function setSettings(array $settings) : self
    {
        $this->settings = $settings;
        return $this;
    }

    public function getSettings() : array
    {
        return $this->settings;
    }

    public function setSetting(string $key, $value) : self
    {
        $this->settings[$key] = $value;
        return $this;
    }

    public function unsetSetting(string $key)
    {
        if (isset($this->settings[$key])) {
            unset($this->settings[$key]);
        }
        return $this;
    }

    abstract public function connect() : bool;

    abstract public function disconnect() : bool;

    abstract public function fetch(EntityMap $entityMap, string $identifier) : EntityValue;

    abstract public function push(EntityMap $entityMap, EntityValue $entityValue) : bool;
}