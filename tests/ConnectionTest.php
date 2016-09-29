<?php

use Liteview\Connection;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

class ConnectionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function test_connection_sends_get_request()
    {
        $connection = $this->getMockConnection([new Response(200)]);

        $this->assertInstanceOf('\GuzzleHttp\Psr7\Response', $connection->get('foo'));
    }

    public function test_connection_sends_post_request()
    {
        $connection = $this->getMockConnection([new Response(200)]);

        $this->assertInstanceOf('\GuzzleHttp\Psr7\Response', $connection->post('foo'));
    }

    public function test_requests_send_appkey_header()
    {
        $history = [];
        $connection = $this->getMockConnection([new Response(200)], $history);
        $connection->get('foo');

        // Ensure that the last request's appkey header is set properly.
        $this->assertEquals(
            $history[0]['request']->getHeader('appkey')[0],
            $connection->getKey()
        );
    }

    public function test_request_uri_has_username()
    {
        $history = [];
        $connection = $this->getMockConnection([new Response(200)], $history);
        $connection->get('foo');

        $uri = $history[0]['request']->getUri();
        $this->assertContains($connection->getUsername(), $uri->getPath());
    }

    protected function getMockConnection(array $responses, array &$container = [])
    {
        $handler = HandlerStack::create(new MockHandler($responses));
        $handler->push(Middleware::history($container));

        return new Connection('user', 'key', ['handler' => $handler]);
    }
}
