<?php

namespace Differ\Formatters\Plain;

use function Functional\flatten;

function format(array $astTree): string
{
    return implode("\n", flatten(render($astTree, '')));
}

function render(array $tree, string $path): array
{
    return array_map(function ($node) use ($path) {
        switch ($node['type']) {
            case 'updated':
                $value1 = stringify($node['value1']);
                $value2 = stringify($node['value2']);
                return "Property '$path{$node['key']}' was updated. From $value1 to $value2";
            case 'added':
                $value = stringify($node['value2']);
                return "Property '$path{$node['key']}' was added with value: $value";
            case 'removed':
                return "Property '$path{$node['key']}' was removed";
            case 'unchanged':
                return [];
            case 'parent':
                $newPath = "$path{$node['key']}.";
                $children = $node['children'];
                return render($children, $newPath);
        }
    }, $tree);
}

function stringify($value): string
{
    if (is_object($value)) {
        return "[complex value]";
    }

    if ($value === null) {
        return 'null';
    }

    return var_export($value, true);
}
