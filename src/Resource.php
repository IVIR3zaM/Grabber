<?php
namespace IVIR3aM\Grabber;

use IVIR3aM\Grabber\Entities\Map as EntityMap;
use IVIR3aM\Grabber\Entities\Value as EntityValue;
use IVIR3aM\Grabber\Resources\Exception;

/**
 * Class Resource
 * Abstraction Layer for any kind of resource
 * @package IVIR3aM\Grabber
 */
abstract class Resource implements \Countable
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * Resource constructor.
     * @param array|null $settings
     */
    public function __construct(array $settings = null)
    {
        if (is_array($settings)) {
            $this->setSettings($settings);
            $this->connect();
        }
    }

    public function __destruct()
    {
        if ($this->isConnected()) {
            $this->disconnect();
        }
    }

    /**
     * Setting all settings required
     * @param array $settings
     * @return Resource
     */
    public function setSettings(array $settings) : Resource
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * Getting all current settings
     * @return array list of settings
     */
    public function getSettings() : array
    {
        return $this->settings;
    }

    /**
     * Set a single setting
     * @param string $key
     * @param $value
     * @return Resource
     */
    public function setSetting(string $key, $value) : Resource
    {
        $this->settings[$key] = $value;
        return $this;
    }

    /**
     * Get a single setting value
     * @param string $key
     * @return mixed the setting value
     */
    public function getSetting(string $key)
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        }
    }

    /**
     * Remove a single setting value
     * @param string $key
     * @return $this
     */
    public function unsetSetting(string $key)
    {
        if (isset($this->settings[$key])) {
            unset($this->settings[$key]);
        }
        return $this;
    }

    /**
     * @return int number of settings elements
     */
    public function count() : int
    {
        return count($this->settings);
    }

    /**
     * Connect to resource
     * @throws Exception on connection failure
     * @return Resource
     */
    abstract public function connect() : Resource;

    /**
     * Disconnect from resource
     * @return Resource
     */
    abstract public function disconnect() : Resource;

    /**
     * Check connection to resource
     * @return bool whether we are connected to resource or not
     */
    abstract public function isConnected() : bool;

    /**
     * Fetch an Entity from Resource base on Identifier and Entity Map
     * @param EntityMap $entityMap
     * @param string $identifier
     * @throws Exception on any failure
     * @return EntityValue
     */
    abstract public function fetch(EntityMap $entityMap, string $identifier) : EntityValue;

    /**
     * Push and save an Entity to Resource base on Entity Map
     * @param EntityMap $entityMap
     * @param EntityValue $entityValue
     * @return bool whether pushing was successful or not
     */
    abstract public function push(EntityMap $entityMap, EntityValue $entityValue) : bool;
}