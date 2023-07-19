<?php
namespace App\Helpers;

class FileLoader
{
    private $formatHandler;
    private $allowedFormats;


    public function __construct()
    {
        $this->allowedFormats = $this->getConfiguredFormats();
    }

    public function loadFile(string $filename): array
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (!in_array($extension, $this->allowedFormats)) {
            throw new \Exception('Format "' . $extension . '" is not allowed.');
        }

        $this->setFormatHandler($extension);

        return $this->formatHandler->parse($filename);
    }

    private function getConfiguredFormats(): array
    {
        $config = require_once __DIR__ . '/../config/config.php';
        return $config['file_formats'] ?? [];
    }

    private function setFormatHandler(string $extension): void
    {
        $formatClass = '\App\Formats\\' . ucfirst($extension) . 'Format';
        if (class_exists($formatClass)) {
            $this->formatHandler = new $formatClass();
        } else {
            throw new \Exception('Format handler for "' . $formatClass  . '" not found.');
        }
    }
}
