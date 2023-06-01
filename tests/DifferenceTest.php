<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    public const PATH_TO_FIRST_JSON_FILES = 'tests/fixtures/file1_flat_structure.json';
    public const PATH_TO_SECOND_JSON_FILES = 'tests/fixtures/file2_flat_structure.json';

    /**
     * @dataProvider argumentProviderForFlatStructure
     * @dataProvider argumentProviderForTreeStructureStylishFormat
     */

    public function testGenDiff($firstPath, $secondPath, $expected, $style = 'stylish')
    {
        $this->assertEquals($expected, genDiff($firstPath, $secondPath, $style));
    }

    public function argumentProviderForFlatStructure(): array
    {
        $firstPathFlatJson = 'tests/fixtures/file1_flat_structure.json';
        $secondPathFlatJson = 'tests/fixtures/file2_flat_structure.json';

        $expectedStylishFlat = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_flat_structure')));

        return [
            [$firstPathFlatJson, $secondPathFlatJson, $expectedStylishFlat],
        ];
    }

    public function argumentProviderForTreeStructureStylishFormat(): array
    {
        $expectedStylish = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_flat_structure')));

        return [
            [self::PATH_TO_FIRST_JSON_FILES, self::PATH_TO_SECOND_JSON_FILES, $expectedStylish],
            [self::PATH_TO_FIRST_JSON_FILES, self::PATH_TO_SECOND_JSON_FILES, $expectedStylish, 'stylish'],
        ];
    }

    public function getFixtureFullPath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}
