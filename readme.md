# Console

Latest **Symfony Console** integration for **Nette Framework 3**

[![Build Status](https://travis-ci.org/rostenkowski/console.svg?branch=master)](https://travis-ci.org/rostenkowski/console)
[![Coverage Status](https://coveralls.io/repos/github/rostenkowski/console/badge.svg)](https://coveralls.io/github/rostenkowski/console)
[![Code Climate](https://codeclimate.com/github/rostenkowski/console/badges/gpa.svg)](https://codeclimate.com/github/rostenkowski/console)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rostenkowski/console/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rostenkowski/console/?branch=master)

## Installation

```bash
composer require rostenkowski/console
```

## Usage

Register extension in `config.neon`.
```yaml
extensions: 
  console: Rostenkowski\Console\Extension
```

List your command in the `console.commands` configuration section.
```yaml
console:
  commands:
    foo: MyNamespace\FooCommand
```

Alternatively you can add your command as a service.
```yaml
services:
  fooCommand: MyNamespace\FooCommand
```
