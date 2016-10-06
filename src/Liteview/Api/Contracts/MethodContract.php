<?php

namespace Liteview\Api\Contracts;

interface MethodContract
{
    /**
     * Perform a GET request for the specified resource.
     *
     * @param  string $resource
     * @param  string $body
     * @return \GuzzleHttp\Psr7\Response
     */
    public function get($resource, $body, $params);

    /**
     * Perform a POST request on the specified resource.
     *
     * @param  string $resource
     * @param  string $body
     * @return \GuzzleHttp\Psr7\Response
     */
    public function post($resource, $body, $params);
}
