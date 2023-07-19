<?php
namespace App\Helpers;
include 'C:\xampp\htdocs\app\formats\CsvFormat.php';
include 'C:\xampp\htdocs\app\formats\JsonFormat.php';
include 'C:\xampp\htdocs\app\formats\XmlFormat.php';

/**
 * FileLoader class
 */
class FileLoader
{
    private $formatHandler;
    private $allowedFormats;

    public function __construct()
    {
        $this->allowedFormats = $this->getConfiguredFormats();
    }

    /**
     * Load file
     *
     * @param string $filename File path
     * @return array File data
     * @throws \Exception If file format is not allowed
     */
    public function loadFile(string $filename): array
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
     
        // Check if file format is allowed
        if (!in_array($extension, $this->allowedFormats)) {
            throw new \Exception('Format "' . $extension . '" is not allowed.');
        }

        // Set format handler
        $this->setFormatHandler($extension);

        // Parse file
        return $this->formatHandler->parse($filename);
    }

    /**
     * Get configured formats
     *
     * @return array Configured formats
     */
    private function getConfiguredFormats(): array
    {
        $config = require_once __DIR__ . '/../config/config.php';
        return $config['file_formats'] ?? []; // ?? is null coalescing operator
    }

    /**
     * Set format handler
     *
     * @param string $extension File extension (json, xml, csv)
     * @return void
     * @throws \Exception If format handler class not found
     */
    private function setFormatHandler(string $extension): void
    {
        // Set format handler
        $formatClass = '\App\Formats\\' . ucfirst($extension) . 'Format';
        // Check if format handler class exists
        if (class_exists($formatClass)) {
            // Create format handler object
            $this->formatHandler = new $formatClass();
        } else {
            // Throw exception if format handler class not found
            throw new \Exception('Format handler for "' . $formatClass  . '" not found.');
        }
    }
}
