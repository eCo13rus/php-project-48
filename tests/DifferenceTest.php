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
         $firstPath = $this->getFixturePath($firstPath);
         $secondPath = $this->getFixturePath($secondPath);
         $expectedFile = $this->getFixturePath($expectedFile);
    
         $this->assertStringEqualsFile($expectedFile, genDiff($firstPath, $secondPath, $style));
    }
    
    public function argumentProvider(): array
    {
         return [
            ['file1_flat.json', 'file2_flat.json', 'result_formatter_stylish'],
            ['file1_flat.yaml', 'file2_flat.yml', 'result_formatter_stylish'],
    
            ['file1_tree.json', 'file2_tree.json', 'result_stylish_formatter_tree'],
            ['file1_tree.json', 'file2_tree.json', 'result_stylish_formatter_tree', 'stylish'],
    
            ['file1_tree.yaml', 'file2_tree.yaml', 'result_stylish_formatter_tree'],
            ['file1_tree.yaml', 'file2_tree.yaml', 'result_stylish_formatter_tree', 'stylish'],
    
            ['file1_tree.json', 'file2_tree.json', 'result_plain_formatter_tree', 'plain'],
            ['file1_tree.yaml', 'file2_tree.yaml', 'result_plain_formatter_tree', 'plain'],
    
            ['file1_tree.json', 'file2_tree.json', 'result_formatter_json', 'json'],
            ['file1_tree.yaml', 'file2_tree.yaml', 'result_formatter_json', 'json']
        ];
    }  
}
