<?php
namespace App\Formats;

/**
 * XmlFormat class
 */
class XmlFormat 
{
    /**
     * Parse file
     *
     * @param string $filename 
     * @return array
     */
    public function parse(string $filename): array
    {
        $xml = simplexml_load_file($filename);
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}