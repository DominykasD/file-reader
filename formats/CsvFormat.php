<?php
namespace App\Formats;

class CsvFormat 
{
    public function parse(string $filename): array
    {
        $data = [];
        $file = fopen($filename, 'r');
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        fclose($file);

        return $data;
    }
}