<?php

namespace Liteview\Api\Resources;

use SimpleXMLElement;
use Gestalt\Configuration;
use Liteview\Api\Contracts\ResourceContract;

class Resource extends Configuration implements ResourceContract
{
    /**
     * The base data for the XML object.
     *
     * @var string
     */
    protected $baseData = '<?xml version="1.0" encoding="UTF-8"?><toolkit></toolkit>';

    /**
     * Accessor method for `baseData` property.
     *
     * @return string
     */
    public function getBaseData()
    {
        return $this->baseData;
    }

    /**
     * Convert the resource's data to an XML string.
     *
     * @return string
     */
    public function toXml()
    {
        $xml = new SimpleXMLElement($this->baseData);

        return array_to_xml($this->all(), $xml);
    }
}
