<?php

use Liteview\Api\Payloads\PayloadLoader;

class PayloadLoaderTest extends TestCase
{
    public function test_loader_loads_xml_file_to_array()
    {
        $loader = new PayloadLoader(__DIR__.'/data/resource.xml');

        $this->assertArrayHasKey('foo', $loader->load());
    }
}
