<?php
namespace IVIR3aM\Grabber\Resources;

use IVIR3aM\Grabber\Entities\MapInterface;
use IVIR3aM\Grabber\Entities\ValueInterface;

/**
 * Interface ResourceInterface
 * @package IVIR3aM\Grabber\Resources
 */
interface ResourceInterface
{
    /**
     * Resource constructor.
     * @param array|null $settings
     */
    public function __construct(array $settings = null);

    /**
     * Setting all settings required
     * @param array $settings
     * @return ResourceInterface
     */
    public function setSettings(array $settings) : ResourceInterface;

    /**
     * Getting all current settings
     * @return array list of settings
     */
    public function getSettings() : array;

    /**
     * Set a single setting
     * @param string $key
     * @param $value
     * @return ResourceInterface
     */
    public function setSetting(string $key, $value) : ResourceInterface;

    /**
     * Get a single setting value
     * @param string $key
     * @return mixed the setting value
     */
    public function getSetting(string $key);

    /**
     * Remove a single setting value
     * @param string $key
     * @return $this
     */
    public function unsetSetting(string $key);

    /**
     * Connect to resource
     * @throws Exception on connection failure
     * @return ResourceInterface
     */
    public function connect() : ResourceInterface;

    /**
     * Disconnect from resource
     * @return ResourceInterface
     */
    public function disconnect() : ResourceInterface;

    /**
     * Check connection to resource
     * @return bool whether we are connected to resource or not
     */
    public function isConnected() : bool;

    /**
     * Fetch an Entity from Resource base on Identifier and Entity Map
     * @param MapInterface $entityMap
     * @param string $identifier
     * @throws Exception on any failure
     * @return ValueInterface
     */
    public function fetch(MapInterface $entityMap, string $identifier) : ValueInterface;

    /**
     * Push and save an Entity to Resource base on Entity Map
     * @param MapInterface $entityMap
     * @param ValueInterface $entityValue
     * @return bool whether pushing was successful or not
     */
    public function push(MapInterface $entityMap, ValueInterface $entityValue) : bool;
}