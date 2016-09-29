<?php

use Liteview\Api\Resources\Resource;

class ResourceTest extends TestCase
{
    public function test_resource_converts_to_xml()
    {
        $resource = new Resource([
            'foo' => [
                'bar' => 'baz',
            ],
        ]);

        $this->assertContains('<foo><bar>baz</bar></foo>', $resource->toXml());
    }
}
