<?php
namespace App\Formats;

/**
 * CsvFormat class
 */
class CsvFormat 
{
    /**
     * Parse file
     *
     * @param string $filename 
     * @return array
     */
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