<?php

namespace src\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $content, string $format): array
{
    switch ($format) {
        case 'json':
            return json_decode($content, true);
        case 'yml':
        case 'yaml':
            return Yaml::parse($content);
        default:
            throw new \Exception("Invalid file format");
    }
}
