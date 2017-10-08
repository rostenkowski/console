<?php

namespace Rostenkowski\Console;


use Symfony\Component\Console\Application;
use Tester\Assert;

require __DIR__ . "/bootstrap.php";

$container = container(false);

/** @var Application $console */
$console = $container->getByType(Application::class);

Assert::equal("Goofy's Console", $console->getName());
Assert::equal("2.0.11", $console->getVersion());
Assert::true($console->has('debug:router'));
