<?php

namespace src\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath): array
{
    pathinfo($filePath, PATHINFO_EXTENSION) == 'json' ? $result = parseJson($filePath) : $result = Yaml::parseFile($filePath);
    return $result;
}

function parseJson(string $filePath): array
{
    $result = file_get_contents($filePath);
    return json_decode($result, true);
}
