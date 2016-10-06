<?php

namespace Liteview;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use Liteview\Api\Contracts\MethodContract as LiteviewMethodContract;

class Connection implements LiteviewMethodContract
{
    /**
     * The base URI for the API.
     *
     * @var string
     */
    protected $baseUri = 'https://liteviewapi.imaginefulfillment.com/';

    /**
     * The username for making an API connection.
     *
     * @var string
     */
    protected $username;

    /**
     * The API appkey to authenticate with.
     *
     * @var string
     */
    protected $key;

    /**
     * The HTTP client for making requests.
     *
     * @var \Liteview\Api\Http\Client
     */
    protected $client;

    /**
     * Create a new instance of \Liteview\Connection.
     *
     * @param string $username
     * @param string $options
     * @param string $key
     */
    public function __construct($username, $key, $options = [])
    {
        $this->username = $username;
        $this->key = $key;

        $this->client = new Client(array_merge([
            'base_uri' => $this->baseUri,
            'headers' => [
                'appkey' => $this->key,
                'Content-Type' => 'text/xml',
            ],
        ], $options));
    }

    /**
     * Get the username property.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the key property.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Perform a GET request for the specified resource.
     *
     * @param  string $resource
     * @param  string $body
     * @return \GuzzleHttp\Psr7\Response
     */
    public function get($resource, $body = null, $params = [])
    {
        return $this->send($this->prepare('GET', $resource, $body, $params));
    }

    /**
     * Perform a POST request on the specified resource.
     *
     * @param  string $resource
     * @param  string $body
     * @return \GuzzleHttp\Psr7\Response
     */
    public function post($resource, $body = null, $params = [])
    {
        return $this->send($this->prepare('POST', $resource, $body, $params));
    }

    /**
     * Perform the given request and return the response.
     *
     * @param  \GuzzleHttp\Psr7\Request $request
     * @return \GuzzleHttp\Psr7\Response
     */
    protected function send(Request $request)
    {
        try {
            $response = $this->client->send($request);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return $response;
    }

    /**
     * Prepare a request for sending.
     *
     * @param  string $method
     * @param  string $resource
     * @param  string $body
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function prepare($method, $resource, $body, $params)
    {
        // Append the username parameter to the end of every resource URI.
        $resource = trim($resource, '/').'/'.$this->username;

        foreach ($params as $param) {
            $resource.='/'.$param;
        }

        return new Request($method, $resource, [], $body);
    }
}
