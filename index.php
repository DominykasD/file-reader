<?php
require_once __DIR__ . '/helpers/FileLoader.php';

// Check if the user provided the data format as a command-line argument
if ($argc < 2) {
    echo "Usage: php index.php [csv|xml|json]\n";
    exit(1);
}

// Get the data format from the command-line argument
$dataFormat = strtolower($argv[1]);

// Validate the data format
$allowedFormats = ['csv', 'xml', 'json'];
if (!in_array($dataFormat, $allowedFormats)) {
    echo "Invalid data format. Available formats: csv, xml, json\n";
    exit(1);
}

$file = __DIR__ . '/data//' . 'data.' . $dataFormat;

$fileLoader = new App\Helpers\FileLoader();
$data = $fileLoader->loadFile($file);

print_r($data);