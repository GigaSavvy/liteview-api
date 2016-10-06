<?php

namespace Liteview\Api\Payloads;

use Gestalt\Loaders\LoaderInterface;

class PayloadLoader implements LoaderInterface
{
    /**
     * The filename to load the XML schema from.
     *
     * @var string
     */
    protected $filename;

    /**
     * Create a new instance of Liteview\Api\Payloads\PayloadLoader.
     *
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = realpath($filename);
    }

    /**
     * Load the configuration items and return them as an array.
     *
     * @return array
     */
    public function load()
    {
        $xml = simplexml_load_file($this->filename, 'SimpleXMLElement');

        return xml_to_array($xml);
    }
}
