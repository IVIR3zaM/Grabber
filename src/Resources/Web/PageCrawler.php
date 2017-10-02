<?php
namespace IVIR3aM\Grabber\Resources\Web;

use Goutte\Client;
use IVIR3aM\Grabber\Entities\Maps\AbstractMap;
use IVIR3aM\Grabber\Entities\AbstractValue;
use IVIR3aM\Grabber\Entities\AbstractValueFactory;
use IVIR3aM\Grabber\Resources\AbstractResource;
use IVIR3aM\Grabber\Resources\Exception;
use Symfony\Component\DomCrawler\Crawler;

class PageCrawler extends AbstractResource
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * @var string
     */
    protected $url;

    protected function getClient() : Client
    {
        if (!$this->client) {
            $this->client = new Client();
        }
        return $this->client;
    }

    public function getCrawler(string $url = null, string $method = 'GET') : Crawler
    {
        if (is_null($url) && !$this->crawler) {
            throw new Exception('Url not specified');
        }
        if ('GET' != $method || $this->url != $url) {
            $this->crawler = $this->getClient()->request($method, $url, $this->getSettings());
            $this->url = $url;
        }
        return $this->crawler;
    }

    /**
     * Fetch an Entity from Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValueFactory $factory
     * @throws Exception on any failure
     * @return AbstractValue
     */
    public function fetch(AbstractMap $map, AbstractValueFactory $factory) : AbstractValue
    {

    }

    /**
     * Push and save an Entity to Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValue $entity
     * @return bool whether pushing was successful or not
     */
    public function push(AbstractMap $map, AbstractValue $entity) : bool
    {

    }

    /**
     * Fetch all Entities from Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValueFactory $factory
     * @throws Exception on any failure
     * @return array
     */
    public function fetchAll(AbstractMap $map, AbstractValueFactory $factory) : array
    {

    }

    /**
     * Push and save all Entities to Resource base on Entity Map
     * @param AbstractMap $map
     * @param AbstractValue[] $entities
     * @return bool whether pushing was successful or not
     */
    public function pushAll(AbstractMap $map, array $entities) : bool
    {

    }
}