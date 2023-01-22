<?php

namespace tests\DiffTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffTest extends TestCase
{
    public function addDataProvider()
    {
        return [
            [
                'tests/fixtures/resultStylish.txt',
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'stylish'
            ],
            [
                'tests/fixtures/resultStylish.txt',
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'stylish'
            ],
            [
                'tests/fixtures/resultPlain.txt',
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'plain'
            ],
            [
                'tests/fixtures/resultPlain.txt',
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'plain'
            ],
            [
                'tests/fixtures/resultJson.txt',
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'json'
            ],
            [
                'tests/fixtures/resultJson.txt',
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'json'
            ]
        ];
    }

    /**
     * @dataProvider addDataProvider
     */

    public function testGendiff($resultPath, $path1, $path2, $format)
    {
        $expectedResult = file_get_contents($resultPath);
        $result = genDiff($path1, $path2, $format);
        $this->assertTrue($result == $expectedResult);
    }
}
