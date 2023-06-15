<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\Formatters\format;
use function Functional\sort;

function parseFile(string $filePath): object
{
    if (!file_exists($filePath)) {
        throw new \Exception("File {$filePath} does not exist");
    }

    $fileContent = (string) file_get_contents($filePath, true);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    return parse($fileContent, $extension);
}

function genDiff(string $pathToFirstFile, string $pathToSecondFile, string $formatter = 'stylish'): string
{
    $dataFirstFile = parseFile($pathToFirstFile);
    $dataSecondFile = parseFile($pathToSecondFile);
    $astTree = computeDifference($dataFirstFile, $dataSecondFile);
    return format($astTree, $formatter);
}



function computeDifference(object $dataFirstFile, object $dataSecondFile): array
{
    $data1 = get_object_vars($dataFirstFile);
    $data2 = get_object_vars($dataSecondFile);
    $mergeKeys = array_merge(array_keys($data1), array_keys($data2));
    $sortKeys = sort($mergeKeys, fn ($left, $right) => strcmp($left, $right));
    $orderedKeys = array_unique($sortKeys);
    return array_map(function ($key) use ($data1, $data2) {
        switch (true) {
            case !array_key_exists($key, $data1):
                return ['key' => $key, 'value2' => $data2[$key], 'type' => 'added'];
            case !array_key_exists($key, $data2):
                return ['key' => $key, 'value1' => $data1[$key], 'type' => 'removed'];
            case is_object($data1[$key]) && is_object($data2[$key]):
                $children = computeDifference($data1[$key], $data2[$key]);
                return ['key' => $key,'type' => 'parent', 'children' => $children];
            case $data1[$key] === $data2[$key]:
                return  ['key' => $key, 'value1' => $data1[$key], 'type' => 'unchanged'];
            default:
                return ['key' => $key, 'value1' => $data1[$key], 'value2' => $data2[$key], 'type' => 'updated'];
        }
    }, $orderedKeys);
}
