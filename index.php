<?php
require_once __DIR__ . '/helpers/FileLoader.php';

$file = __DIR__ . '/data/data.json';

$fileLoader = new \App\Helpers\FileLoader();
$data = $fileLoader->loadFile($file);

print_r($data);