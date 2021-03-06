Yaml CLI Reader [![Build Status](https://travis-ci.org/atphp/yaml-cli-reader.svg)](https://travis-ci.org/atphp/yaml-cli-reader)
====

Yaml validator

- [x] Yaml file validate with useful debug message
- [x] Validate multiple files
- [x] Support import syntax with glob file name

## Install

```
composer global require atphp/yaml-cli-reader:~0.1.0
```

## Usage

```
yaml-reader /path/to/file.yml
```

## Validate multiple files

```
yaml-reader /path/to/file1.yml /path/to/file2.yml
```

## Import syntax

```
# ...
imports:
  - { resources: "subFolder1/*.yml" }
  - { resources: "subFolder2/*.yml" }
# ...
```
