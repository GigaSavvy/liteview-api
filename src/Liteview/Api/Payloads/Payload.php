<?php

namespace Liteview\Api\Payloads;

use SimpleXMLElement;
use Gestalt\Configuration;
use Liteview\Api\Contracts\PayloadContract;

class Payload extends Configuration implements PayloadContract
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
