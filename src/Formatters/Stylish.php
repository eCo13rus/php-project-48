<?php

namespace Differ\Formatters\Stylish;

const NUMBER_INDENTS = 4;

function format(array $astTree): string
{
    return render($astTree);
}

function render(array $astTree, int $depth = 0): string
{
    $indent = buildIndent($depth, NUMBER_INDENTS);
    $result = array_map(function ($node) use ($depth, $indent) {
        $deepening = $depth + 1;
        switch ($node['type']) {
            case 'parent':
                return "{$indent}    {$node['key']}: " . render($node['children'], $deepening) . "\n";
            case 'added':
                $valueAdded = stringify([$node['value2']], $deepening);
                return "{$indent}  + {$node['key']}: {$valueAdded}\n";
            case 'removed':
                $valueRemoved = stringify([$node['value1']], $deepening);
                return "{$indent}  - {$node['key']}: {$valueRemoved}\n";
            case 'updated':
                $valueRemoved = stringify([$node['value1']], $deepening);
                $valueAdd = stringify([$node['value2']], $deepening);
                return "{$indent}  - {$node['key']}: {$valueRemoved}\n{$indent}  + {$node['key']}: {$valueAdd}\n";
            case 'unchanged':
                $valueUnchanged = stringify([$node['value1']], $deepening);
                return "{$indent}    {$node['key']}: {$valueUnchanged}\n";
        }
    }, $astTree);
    return "{\n" . implode("", $result) . "{$indent}}";
}


function buildIndent(int $depth, int $numberOfIndents): string
{
    return str_repeat(" ", $depth * $numberOfIndents);
}

function stringify(array $dataValue, int $depth): string
{
    $value = $dataValue[0];
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } elseif (!is_object($value)) {
        return (string) $value;
    }
    $indent = buildIndent($depth, NUMBER_INDENTS);
    $stringOfArray = array_map(function ($key, $item) use ($depth, $indent) {
        $deepening = $depth + 1;
        $typeOfValueOfNode = (is_object($item)) ? stringify([$item], $deepening) : $item;
        return $indent . "    " . "$key: " . $typeOfValueOfNode . "\n";
    }, array_keys(get_object_vars($value)), get_object_vars($value));
    return '{' . "\n" . implode("", $stringOfArray) . $indent . '}';
}
