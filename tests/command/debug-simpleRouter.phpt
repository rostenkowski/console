<?php

namespace Rostenkowski\Console;


use Nette\Application\Routers\SimpleRouter;
use Rostenkowski\Console\Command\DebugRouter;
use Symfony\Component\Console\Tester\CommandTester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * TEST: debug simple router
 */
$router = new SimpleRouter([
	'presenter' => 'Default',
	'action'    => 'default',
]);
$tester = new CommandTester(new DebugRouter($router));
Assert::same(0, $tester->execute([]));
Assert::matchFile(__DIR__ . '/expected/simpleRouter.txt', $tester->getDisplay());
