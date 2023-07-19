<?php
namespace App\Formats;

/**
 * JsonFormat class
 */
class JsonFormat 
{
    /**
     * Parse file
     *
     * @param string $filename
     * @return array
     */
    public function parse(string $filename): array
    {
        $json = file_get_contents($filename);
        return json_decode($json, true);
    }
}