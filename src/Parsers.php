<?php

namespace src\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath)
{
    $format = pathinfo($filePath, PATHINFO_EXTENSION);
    switch ($format) {
        case 'json':
            $result = file_get_contents($filePath);
            return json_decode($result, true);
        case 'yml':
            return Yaml::parseFile($filePath);
        case 'yaml':
            return Yaml::parseFile($filePath);
        default:
            throw new \Exception("Unknown extension: '{$format}'");
    }
}
