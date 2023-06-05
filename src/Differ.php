<?php

namespace Differ\Differ;

use function Differ\Parsers\convertingFile;
use function Differ\Formatters\formatSelection;
use function Functional\sort;

function genDiff(string $pathToFirstFile, string $pathToSecondFile, string $formatter = 'stylish'): string
{
    $firstFileContent = (string) file_get_contents($pathToFirstFile, true);
    $secondFileContent = (string) file_get_contents($pathToSecondFile, true);
    $extensionFirstFile = pathinfo($pathToFirstFile, PATHINFO_EXTENSION);
    $extensionSecondFile = pathinfo($pathToSecondFile, PATHINFO_EXTENSION);
    $dataFirstFile = convertingFile($firstFileContent, $extensionFirstFile);
    $dataSecondFile = convertingFile($secondFileContent, $extensionSecondFile);
    $astTree = differenceCalculator($dataFirstFile, $dataSecondFile);
    return formatSelection($astTree, $formatter);
}

function differenceCalculator(object $dataFirstFile, object $dataSecondFile): array
{
    $data1 = get_object_vars($dataFirstFile);
    $data2 = get_object_vars($dataSecondFile);
    $mergeKeys = array_merge(array_keys($data1), array_keys($data2));
    $sortKeys = sort($mergeKeys, fn ($left, $right) => strcmp($left, $right));
    $uniqKeys = array_unique($sortKeys);

    return array_map(function ($key) use ($data1, $data2) {
        $type = '';
        if (!array_key_exists($key, $data1)) {
            $type = 'added';
        } elseif (!array_key_exists($key, $data2)) {
            $type = 'removed';
        } elseif (is_object($data1[$key]) && is_object($data2[$key])) {
            $type = 'parent';
        } elseif ($data1[$key] === $data2[$key]) {
            $type = 'unchanged';
        } else {
            $type = 'updated';
        }

        switch ($type) {
            case 'added':
                return ['key' => $key, 'data2Value' => $data2[$key], 'type' => $type];
            case 'removed':
                return ['key' => $key, 'data1Value' => $data1[$key], 'type' => $type];
            case 'parent':
                $children = differenceCalculator($data1[$key], $data2[$key]);
                return ['key' => $key, 'type' => $type, 'children' => $children];
            case 'unchanged':
                return  ['key' => $key, 'data1Value' => $data1[$key], 'type' => $type];
            case 'updated':
                return ['key' => $key, 'data1Value' => $data1[$key], 'data2Value' => $data2[$key], 'type' => $type];
        }
    }, $uniqKeys);
}
