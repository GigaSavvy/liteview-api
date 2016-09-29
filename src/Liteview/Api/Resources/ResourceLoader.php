<?php

namespace Liteview\Api\Resources;

use Gestalt\Loaders\LoaderInterface;

class ResourceLoader implements LoaderInterface
{
    /**
     * The filename to load the XML schema from.
     *
     * @var string
     */
    protected $filename;

    /**
     * Create a new instance of Liteview\Api\Resources\ResourceLoader
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
