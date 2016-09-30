<?php

if (! function_exists('is_assoc')) {
    /**
     * Determine if the given array is considered associative.
     *
     * @param array $array
     * @return boolean
     */
    function is_assoc(array $array)
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }
}

if (! function_exists('array_to_xml')) {
    /**
     * Convert the given array to an XML string.
     *
     * @param  array $data
     * @param  \SimpleXMLElement &$xml
     * @return string
     */
    function array_to_xml($data, &$xml)
    {
        foreach ($data as $element => $value) {
            if (is_array($value)) {
                if (is_assoc($value)) {
                    $subnode = $xml->addChild($element);
                    array_to_xml($value, $subnode);
                } else {
                    // Fast enough.
                    while (count($value) > 0) {
                        array_to_xml([$element => array_shift($value)], $xml);
                    }
                }
            } else {
                $xml->addChild($element, $value);
            }
        }

        return $xml->asXML();
    }
}

if (! function_exists('xml_to_array')) {
    /**
     * Convert the given XML to an array.
     *
     * @param  mixed $xml
     * @return array
     */
    function xml_to_array($xml)
    {
        return json_decode(json_encode($xml), true);
    }
}
