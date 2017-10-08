<?php declare(strict_types=1);

namespace Rostenkowski\Console;


use Nette\Configurator;
use Symfony\Component\Console\Application;

$dir = getcwd();

// safety measure to overrule webserver or shell misconfiguration
umask(0002);

require "$dir/vendor/autoload.php";

$configurator = new Configurator();
$configurator->addParameters([
	'baseDir'        => "$dir",
	'appDir'         => "$dir/app",
	'logDir'         => "$dir/log",
	'tempDir'        => "$dir/temp",
	'wwwDir'         => "$dir/www",
	'debugMode'      => true,
	'productionMode' => false,
	'consoleMode'    => false,
]);

if (file_exists($config = "$dir/app/config.neon")) {
	$configurator->addConfig($config);
}

$container = $configurator->createContainer();
$container->getByType(Application::class)->run();
