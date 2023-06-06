<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\makeStylishFormat;
use function Differ\Formatters\Plain\makePlainFormat;

function formatSelection(array $astTree, string $formatter): string
{
    switch ($formatter) {
        case 'stylish':
            return makeStylishFormat($astTree);
        case 'plain':
            return makePlainFormat($astTree);
        default:
            throw new \Exception("Invalid formatter. The format should be 'stylish' , 'plain' or 'json'");
    }
}
