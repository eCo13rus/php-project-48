<?php

namespace Differ\Formatters\Json;

function format(array $astTree): string
{
    return json_encode($astTree, JSON_THROW_ON_ERROR);
}
