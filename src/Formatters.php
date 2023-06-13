<?php

namespace Differ\Formatters;

function format(array $astTree, string $formatter): string
{
    switch ($formatter) {
        case 'stylish':
            return Stylish\format($astTree);
        case 'plain':
            return Plain\format($astTree);
        case 'json':
            return Json\format($astTree);
        default:
            throw new \Exception("Invalid formatter. The format should be 'stylish' , 'plain' or 'json'");
    }
}
