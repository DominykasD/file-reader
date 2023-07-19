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
        $header = null;
        $delimiter = ',';
        $enclosure = '"';
        $escape = '\\';

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter, $enclosure, $escape)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}