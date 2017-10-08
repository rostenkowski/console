<?php

namespace Rostenkowski\Console;


use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Rostenkowski\Console\Command\DebugRouter;
use Symfony\Component\Console\Tester\CommandTester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * TEST: debug route list
 */
$router = new RouteList();
$router[] = new Route('/', [
	'presenter' => 'Default',
	'action'    => 'default',
	'foo'       => 'bar',
]);
$tester = new CommandTester(new DebugRouter($router));
Assert::same(0, $tester->execute([]));
Assert::matchFile(__DIR__ . '/expected/routeList.txt', $tester->getDisplay());
