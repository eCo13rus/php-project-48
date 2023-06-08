### Hexlet tests and linter status:
[![Actions Status](https://github.com/eCo13rus/php-project-48/workflows/hexlet-check/badge.svg)](https://github.com/eCo13rus/php-project-48/actions)
![my-check CI](https://github.com/eCo13rus/php-project-48/actions/workflows/my-check.yml/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/2ea9e1a47d5c57d93717/maintainability)](https://codeclimate.com/github/eCo13rus/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/2ea9e1a47d5c57d93717/test_coverage)](https://codeclimate.com/github/eCo13rus/php-project-48/test_coverage)

# Project Description:
 - The Difference Calculator project is a PHP console utility designed to detect differences between two files. It works with files in JSON, XML and YAML formats and uses recursive comparison to account for data types and structures. The tool provides a choice of different formats for displaying results, including Stylish, Plain and Json.

## Requirements installation:

- PHP
- Composer
- make

### Install Project:

- git clone https://github.com/eCo13rus/php-project-48

- cd php-project-48

- make install

## Use the command:

### Additional information:
- ./bin/gendiff -h

<a href="https://asciinema.org/a/dnSWy9MbR8C49v9px4tQl7tTp" target="_blank"><img src="https://asciinema.org/a/dnSWy9MbR8C49v9px4tQl7tTp.svg" /></a>

## Use the command:

### Comparison of json files
- ./bin/gendiff tests/fixtures/file1_flat.json tests/fixtures/file2_flat.json 

<a href="https://asciinema.org/a/n1OhFzkY1uFhYCTxoar43PVHW" target="_blank"><img src="https://asciinema.org/a/n1OhFzkY1uFhYCTxoar43PVHW.svg" /></a>

## Use the command:

### Comparison of yaml(yml) files
- ./bin/gendiff tests/fixtures/file1_flat.yaml tests/fixtures/file2_flat.yml

<a href="https://asciinema.org/a/Mh4N3xsA6SHkSXRZlZuxO0odJ" target="_blank"><img src="https://asciinema.org/a/Mh4N3xsA6SHkSXRZlZuxO0odJ.svg" /></a>

## Use the command:

### Recursive comparison of json files with nested structure
./bin/gendiff tests/fixtures/file1_tree.json tests/fixtures/file2_tree.json

<a href="https://asciinema.org/a/L3bhoI5yP4svgxqpaeupjMDtw" target="_blank"><img src="https://asciinema.org/a/L3bhoI5yP4svgxqpaeupjMDtw.svg" /></a>

## Use the command:

### Comparison output in flat format:
./bin/gendiff --format plain tests/fixtures/file1_flat.json tests/fixtures/file2_flat.json

<a href="https://asciinema.org/a/W6JE0GdDzbJQp6cANr9K6SfxZ" target="_blank"><img src="https://asciinema.org/a/W6JE0GdDzbJQp6cANr9K6SfxZ.svg" /></a>

## Use the command:

### Comparison output in json format:
./bin/gendiff --format json tests/fixtures/file1_tree.json tests/fixtures/file2_tree.json

- or

./bin/gendiff --format json tests/fixtures/file1_flat.json tests/fixtures/file2_flat.json

<a href="https://asciinema.org/a/YqHXzm0McftQRNS7NwM9Hwgo1" target="_blank"><img src="https://asciinema.org/a/YqHXzm0McftQRNS7NwM9Hwgo1.svg" /></a>