<?php

namespace Liteview\Api\Contracts;

interface ResourceContract
{
    /**
     * Return an XML string representation of the object.
     *
     * @return string
     */
    public function toXml();
}
