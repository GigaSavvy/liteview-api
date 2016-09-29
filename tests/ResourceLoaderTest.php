<?php

use Liteview\Api\Resources\ResourceLoader;

class ResourceLoaderTest extends TestCase
{
    public function test_loader_loads_xml_file_to_array()
    {
        $loader = new ResourceLoader(__DIR__.'/data/resource.xml');

        $this->assertArrayHasKey('foo', $loader->load());
    }
}
