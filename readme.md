# Console

Symfony Console integration for Nette Framework 3.0

[![Build Status](https://travis-ci.org/rostenkowski/console.svg?branch=master)](https://travis-ci.org/rostenkowski/console)
[![Coverage Status](https://coveralls.io/repos/github/rostenkowski/console/badge.svg)](https://coveralls.io/github/rostenkowski/console)
[![Code Climate](https://codeclimate.com/github/rostenkowski/console/badges/gpa.svg)](https://codeclimate.com/github/rostenkowski/console)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rostenkowski/console/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rostenkowski/console/?branch=master)

## Installation

```bash
composer require rostenkowski/console
```

## Usage

```yaml
extensions: 
  console: Rostenkowski\Console\Extension
```

## Commands

### 1. List your command in the `console.commands` section
```yaml
console:
  commands:
    foo: MyNamespace\FooCommand
```

### 2. Add Command as a Service 
```yaml
services:
  fooCommand: MyNamespace\FooCommand
```
