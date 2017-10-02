<?php
namespace IVIR3aM\Grabber\Resources;

use IVIR3aM\Grabber\Entities\Maps\AbstractMap;
use IVIR3aM\Grabber\Entities\AbstractValue;
use IVIR3aM\Grabber\Entities\AbstractValueFactory;

/**
 * Class AbstractResource
 * Abstraction Layer for any kind of resource
 * @package IVIR3aM\Grabber
 */
abstract class AbstractResource implements \Countable
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
        }
    }

    /**
     * Setting all settings required
     * @param array $settings
     * @return AbstractResource
     */
    public function setSettings(array $settings) : AbstractResource
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
     * @return AbstractResource
     */
    public function setSetting(string $key, $value) : AbstractResource
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
     * Fetch an Entity from Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValueFactory $factory
     * @throws Exception on any failure
     * @return AbstractValue
     */
    abstract public function fetch(AbstractMap $map, AbstractValueFactory $factory) : AbstractValue;

    /**
     * Push and save an Entity to Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValue $entity
     * @return bool whether pushing was successful or not
     */
    abstract public function push(AbstractMap $map, AbstractValue $entity) : bool;

    /**
     * Fetch all Entities from Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValueFactory $factory
     * @throws Exception on any failure
     * @return array
     */
    abstract public function fetchAll(AbstractMap $map, AbstractValueFactory $factory) : array;

    /**
     * Push and save all Entities to Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValue[] $entities
     * @return bool whether pushing was successful or not
     */
    abstract public function pushAll(AbstractMap $map, array $entities) : bool;
}