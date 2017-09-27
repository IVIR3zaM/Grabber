<?php
namespace IVIR3aM\Grabber\Resources;

use IVIR3aM\Grabber\Entities\MapInterface;
use IVIR3aM\Grabber\Entities\ValueInterface;

/**
 * Class Resource
 * Abstraction Layer for any kind of resource
 * @package IVIR3aM\Grabber
 */
abstract class Resource implements ResourceInterface, \Countable
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
     * @return ResourceInterface
     */
    public function setSettings(array $settings) : ResourceInterface
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
     * @return ResourceInterface
     */
    public function setSetting(string $key, $value) : ResourceInterface
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
     * @return ResourceInterface
     */
    abstract public function connect() : ResourceInterface;

    /**
     * Disconnect from resource
     * @return ResourceInterface
     */
    abstract public function disconnect() : ResourceInterface;

    /**
     * Check connection to resource
     * @return bool whether we are connected to resource or not
     */
    abstract public function isConnected() : bool;

    /**
     * Fetch an Entity from Resource base on Identifier and Entity Map
     * @param MapInterface $entityMap
     * @param string $identifier
     * @throws Exception on any failure
     * @return ValueInterface
     */
    abstract public function fetch(MapInterface $entityMap, string $identifier) : ValueInterface;

    /**
     * Push and save an Entity to Resource base on Entity Map
     * @param MapInterface $entityMap
     * @param ValueInterface $entityValue
     * @return bool whether pushing was successful or not
     */
    abstract public function push(MapInterface $entityMap, ValueInterface $entityValue) : bool;
}