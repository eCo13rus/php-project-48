<?php

namespace Differ\Cli;

use Docopt;

function start()
{
    $doc = <<<DOC
    Generate diff

    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>

    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    DOC;

    $args = Docopt::handle($doc, ['version' => 'gendiff v: 0.0.1']);
    foreach ($args as $key => $value) {
        echo $key . ': ' . json_encode($value) . PHP_EOL;
    }
}
