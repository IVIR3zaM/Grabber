<?php
namespace IVIR3aM\Grabber\Entities\Maps\Web;

use IVIR3aM\Grabber\Entities\Exception;
use IVIR3aM\Grabber\Entities\Maps\AbstractMap;

/**
 * Class PageCrawlerMap
 * @package IVIR3aM\Grabber\Entities\Maps\Web
 */
class PageCrawlerMap extends AbstractMap
{
    /**
     * @param string $name
     * @param array $settings
     * @throws Exception
     * @return AbstractMap
     */
    public function setFieldMap(string $name, array $settings) : AbstractMap
    {
        if (!$this->getSpecification()->getField($name)) {
            throw new Exception(sprintf('Invalid Field name "%s"', $name));
        }
        if (!isset($settings['filter'], $settings['target']) || ($settings['target'] == 'attribute' && !isset($settings['attribute']))) {
            throw new Exception(sprintf('Invalid settings for Field "%s"', $name));
        }
        $this->items[$name] = $settings;
        return $this;
    }
}