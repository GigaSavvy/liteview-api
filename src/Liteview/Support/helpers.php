<?php

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
                $subnode = $xml->addChild($element);
                array_to_xml($value, $subnode);
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
