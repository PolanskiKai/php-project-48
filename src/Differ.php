<?php

namespace Differ\Differ;

use function src\Parsers\parseFile;
use function Functional\sort;
use function src\Formatters\Format\chooseFormat;

function makeNode(string $key, string $type, mixed $oldValue, mixed $newValue, mixed $children = null): array
{
    return [
        'key' => $key,
        'type' => $type,
        'oldValue' => $oldValue,
        'newValue' => $newValue,
        'children' => $children
    ];
}

function makeDiff(array $arr1, array $arr2): array
{
    $keys1 = array_keys($arr1);
    $keys2 = array_keys($arr2);
    $unionKeys = array_unique(array_merge($keys1, $keys2));
    $sortedKeys = sort($unionKeys, fn ($key1, $key2) => $key1 <=> $key2);

    $callback = function ($key) use ($arr1, $arr2) {
        $value1 = $arr1[$key] ?? null;
        $value2 = $arr2[$key] ?? null;
        if (!array_key_exists($key, $arr1)) {
            return makeNode($key, 'added', null, $value2);
        }
        if (!array_key_exists($key, $arr2)) {
            return makeNode($key, 'removed', $value1, null);
        }
        if ($value1 === $value2) {
            return makeNode($key, 'unchanged', $value1, $value2);
        }
        if (!is_array($value1) || !is_array($value2)) {
            return makeNode($key, 'updated', $value1, $value2);
        }
        return makeNode($key, 'complex', null, null, makeDiff($value1, $value2));
    };
    return array_map($callback, $sortedKeys);
}

function genDiff(string $firstPath, string $secondPath, string $format = 'stylish')
{
    [$content1, $format1] = prepareContent($firstPath);
    [$content2, $format2] = prepareContent($secondPath);
    $firstArray = parseFile($content1, $format1);
    $secondArray = parseFile($content2, $format2);
    $result = makeDiff($firstArray, $secondArray);
    return chooseFormat($format, $result);
}

function prepareContent(string $path): array
{
    if (!file_exists($path)) {
        throw new \Exception("Non-existent file path");
    }
    $content = file_get_contents($path);
    $format = pathinfo($path, PATHINFO_EXTENSION);
    return [$content, $format];
}
