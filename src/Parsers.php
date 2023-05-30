<?php

namespace Differ\Parsers;

function convertingFile(string $fileContent, string $extension): object
{
    if ($extension === 'json') {
        return json_decode($fileContent);
    }
}
