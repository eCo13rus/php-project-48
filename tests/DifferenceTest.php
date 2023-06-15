<?php

namespace Tests\Test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    private function getFixturePath(string $filename): string
    {
        return __DIR__ . "/fixtures/{$filename}";
    }

    /**
     * @dataProvider argumentProvider
     */

    public function testGenDiff($firstPath, $secondPath, $expectedFile, $style = 'stylish')
    {
        $this->assertStringEqualsFile($expectedFile, genDiff($firstPath, $secondPath, $style));
    }

    public function argumentProvider(): array
    {
        return [
            [$this->getFixturePath('file1_flat.json'), $this->getFixturePath('file2_flat.json'), $this->getFixturePath('result_formatter_stylish')],
            [$this->getFixturePath('file1_flat.yaml'), $this->getFixturePath('file2_flat.yml'), $this->getFixturePath('result_formatter_stylish')],

            [$this->getFixturePath('file1_tree.json'), $this->getFixturePath('file2_tree.json'), $this->getFixturePath('result_stylish_formatter_tree')],
            [$this->getFixturePath('file1_tree.json'), $this->getFixturePath('file2_tree.json'), $this->getFixturePath('result_stylish_formatter_tree'), 'stylish'],

            [$this->getFixturePath('file1_tree.yaml'), $this->getFixturePath('file2_tree.yaml'), $this->getFixturePath('result_stylish_formatter_tree')],
            [$this->getFixturePath('file1_tree.yaml'), $this->getFixturePath('file2_tree.yaml'), $this->getFixturePath('result_stylish_formatter_tree'), 'stylish'],

            [$this->getFixturePath('file1_tree.json'), $this->getFixturePath('file2_tree.json'), $this->getFixturePath('result_plain_formatter_tree'), 'plain'],
            [$this->getFixturePath('file1_tree.yaml'), $this->getFixturePath('file2_tree.yaml'), $this->getFixturePath('result_plain_formatter_tree'), 'plain'],
            
            [$this->getFixturePath('file1_tree.json'), $this->getFixturePath('file2_tree.json'), $this->getFixturePath('result_formatter_json'), 'json'],
            [$this->getFixturePath('file1_tree.yaml'), $this->getFixturePath('file2_tree.yaml'), $this->getFixturePath('result_formatter_json'), 'json']
        ];
    }
}

