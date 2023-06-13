<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    public const PATH_TO_FIRST_JSON_FILE = 'tests/fixtures/file1_tree.json';
    public const PATH_TO_SECOND_JSON_FILE = 'tests/fixtures/file2_tree.json';
    public const PATH_TO_FIRST_YAML_FILE = 'tests/fixtures/file1_tree.yaml';
    public const PATH_TO_SECOND_YML_FILE = 'tests/fixtures/file2_tree.yaml';

    /**
     * @dataProvider argumentProvider
     */

    public function testGenDiff($firstPath, $secondPath, $expectedFile, $style = 'stylish')
    {
        $this->assertStringEqualsFile($expectedFile, genDiff($firstPath, $secondPath, $style));
    }

    public function argumentProvider(): array
    {
        $firstPathFlatJson = 'tests/fixtures/file1_flat.json';
        $secondPathFlatJson = 'tests/fixtures/file2_flat.json';

        $firstPathFlatYaml = 'tests/fixtures/file1_flat.yaml';
        $secondPathFlatYml = 'tests/fixtures/file2_flat.yml';

        $expectedStylishFlatFile = __DIR__ . '/fixtures/result_formatter_stylish';
        $expectedStylishFile = __DIR__ . '/fixtures/result_stylish_formatter_tree';
        $expectedPlainFile = __DIR__ . '/fixtures/result_plain_formatter_tree';
        $expectedJsonFile = __DIR__ . '/fixtures/result_formatter_json';

        return [
            [$firstPathFlatJson, $secondPathFlatJson, $expectedStylishFlatFile],
            [$firstPathFlatYaml, $secondPathFlatYml, $expectedStylishFlatFile],
            [self::PATH_TO_FIRST_JSON_FILE, self::PATH_TO_SECOND_JSON_FILE, $expectedStylishFile],
            [self::PATH_TO_FIRST_JSON_FILE, self::PATH_TO_SECOND_JSON_FILE, $expectedStylishFile, 'stylish'],
            [self::PATH_TO_FIRST_YAML_FILE, self::PATH_TO_SECOND_YML_FILE, $expectedStylishFile],
            [self::PATH_TO_FIRST_YAML_FILE, self::PATH_TO_SECOND_YML_FILE, $expectedStylishFile, 'stylish'],
            [self::PATH_TO_FIRST_JSON_FILE, self::PATH_TO_SECOND_JSON_FILE, $expectedPlainFile , 'plain'],
            [self::PATH_TO_FIRST_YAML_FILE, self::PATH_TO_SECOND_YML_FILE, $expectedPlainFile, 'plain'],
            [self::PATH_TO_FIRST_JSON_FILE, self::PATH_TO_SECOND_JSON_FILE, $expectedJsonFile, 'json'],
            [self::PATH_TO_FIRST_YAML_FILE, self::PATH_TO_SECOND_YML_FILE, $expectedJsonFile, 'json']
        ];
    }
}
