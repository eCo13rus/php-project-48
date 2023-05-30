<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\makeStylishFormat;

function formatSelection(array $astTree, string $formatter): string
{
    if ($formatter === 'stylish') {
        return makeStylishFormat($astTree);
    }
}
