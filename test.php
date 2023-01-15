<?php

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = 'vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use function Functional\sort;
use function Funct\Collection\union;
use function src\Parsers\parseFile;
use function src\Merger\makeDiff;
use function src\Formatters\Stylish\makeStylish;
use function src\Formatters\Json\makeJson;

$test1 = parseFile('tests/fixtures/file1.json');
$test2 = parseFile('tests/fixtures/file2.json');

print_r(makeStylish(makeDiff($test1, $test2)));
