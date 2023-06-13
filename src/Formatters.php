<?php

namespace Differ\Formatters;

function format(array $astTree, string $formatter): string
{
    switch ($formatter) {
        case 'stylish':
            return Stylish\formatStylish($astTree);
        case 'plain':
            return Plain\formatPlain($astTree);
        case 'json':
            return Json\formatJson($astTree);
        default:
            throw new \Exception("Invalid formatter. The format should be 'stylish' , 'plain' or 'json'");
    }
}
