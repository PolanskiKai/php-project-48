<?php

namespace Tests\DiffTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffTest extends TestCase
{
    public function addDataProvider()
    {
        return [
            [
                'tests/fixtures/file1',
                'tests/fixtures/file2'
            ]
        ];
    }

    /**
     * @dataProvider addDataProvider
     */

    public function testGendiffStylish($path1, $path2)
    {
        $resultPath = 'tests/fixtures/resultStylish.txt';
        $expectedResult = file_get_contents($resultPath);
        $resultJson = genDiff($path1 . '.json', $path2 . '.json', 'stylish');
        $resultYaml = genDiff($path1 . '.yml', $path2 . '.yml', 'stylish');
        $this->assertEquals($resultJson, $expectedResult);
        $this->assertEquals($resultYaml, $expectedResult);
    }

    /**
     * @dataProvider addDataProvider
     */

    public function testGendiffDefault($path1, $path2)
    {
        $resultPath = 'tests/fixtures/resultStylish.txt';
        $expectedResult = file_get_contents($resultPath);
        $resultJson = genDiff($path1 . '.json', $path2 . '.json');
        $resultYaml = genDiff($path1 . '.yml', $path2 . '.yml');
        $this->assertEquals($resultJson, $expectedResult);
        $this->assertEquals($resultYaml, $expectedResult);
    }

    /**
     * @dataProvider addDataProvider
     */

    public function testGendiffPlain($path1, $path2)
    {
        $resultPath = 'tests/fixtures/resultPlain.txt';
        $expectedResult = file_get_contents($resultPath);
        $resultJson = genDiff($path1 . '.json', $path2 . '.json', 'plain');
        $resultYaml = genDiff($path1 . '.yml', $path2 . '.yml', 'plain');
        $this->assertEquals($resultJson, $expectedResult);
        $this->assertEquals($resultYaml, $expectedResult);
    }

    /**
     * @dataProvider addDataProvider
     */

    public function testGendiffJson($path1, $path2)
    {
        $resultPath = 'tests/fixtures/resultJson.txt';
        $expectedResult = file_get_contents($resultPath);
        $resultJson = genDiff($path1 . '.json', $path2 . '.json', 'json');
        $resultYaml = genDiff($path1 . '.yml', $path2 . '.yml', 'json');
        $this->assertEquals($resultJson, $expectedResult);
        $this->assertEquals($resultYaml, $expectedResult);
    }
}
