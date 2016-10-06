<?php

use Liteview\Api\Payloads\Payload;

class PayloadTest extends TestCase
{
    public function test_payload_converts_to_xml()
    {
        $payload = new Payload([
            'foo' => [
                'bar' => 'baz',
            ],
        ]);

        $this->assertContains('<foo><bar>baz</bar></foo>', $payload->toXml());
    }
}
