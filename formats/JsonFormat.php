<?php
namespace App\Formats;

class JsonFormat 
{
    public function parse(string $filename): array
    {
        $json = file_get_contents($filename);
        return json_decode($json, true);
    }
}