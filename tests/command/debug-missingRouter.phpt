<?php

namespace Rostenkowski\Console;


use Rostenkowski\Console\Command\DebugRouter;
use Symfony\Component\Console\Tester\CommandTester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * TEST: missing router
 */
$tester = new CommandTester(new DebugRouter());
Assert::same(0, $tester->execute([]));
Assert::same('No router service configured' . PHP_EOL, $tester->getDisplay());
