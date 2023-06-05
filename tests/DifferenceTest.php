<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    public const PATH_TO_FIRST_JSON_FILES = 'tests/fixtures/file1.json';
    public const PATH_TO_SECOND_JSON_FILES = 'tests/fixtures/file2.json';
    public const PATH_TO_FIRST_YAML_FILES = 'tests/fixtures/file1.yaml';
    public const PATH_TO_SECOND_YML_FILES = 'tests/fixtures/file2.yml';

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
        $firstPathFlatJson = 'tests/fixtures/file1.json';
        $secondPathFlatJson = 'tests/fixtures/file2.json';

        $firstPathFlatYaml = 'tests/fixtures/file1.yaml';
        $secondPathFlatYml = 'tests/fixtures/file2.yml';

        $expectedStylishFlat = file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter'));

        return [
            [$firstPathFlatJson, $secondPathFlatJson, $expectedStylishFlat],
            [$firstPathFlatYaml, $secondPathFlatYml, $expectedStylishFlat]
        ];
    }

    public function argumentProviderForTreeStructureStylishFormat(): array
    {
        $expectedStylish = file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter'));

        return [
            [self::PATH_TO_FIRST_JSON_FILES, self::PATH_TO_SECOND_JSON_FILES, $expectedStylish],
            [self::PATH_TO_FIRST_JSON_FILES, self::PATH_TO_SECOND_JSON_FILES, $expectedStylish, 'stylish'],
            [self::PATH_TO_FIRST_YAML_FILES, self::PATH_TO_SECOND_YML_FILES, $expectedStylish],
            [self::PATH_TO_FIRST_YAML_FILES, self::PATH_TO_SECOND_YML_FILES, $expectedStylish, 'stylish']
        ];
    }

    public function getFixtureFullPath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}
