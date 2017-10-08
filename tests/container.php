<?php declare(strict_types=1);

namespace Rostenkowski\Console;


use Nette\DI\Compiler;
use Nette\DI\Config\Helpers;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;

function container(bool $debugMode = false, array $config = []): Container
{
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(function (Compiler $compiler) use ($debugMode, $config) {
		$compiler->addExtension('console', new Extension());
		$defaults = [
			'parameters' => [
				'debugMode' => $debugMode,
				'appDir'    => __DIR__,
				'logDir'    => TEMP_DIR,
				'tempDir'   => TEMP_DIR,
			],
			'console'    => [
				'name'    => "Goofy's Console",
				'version' => '2.0.11',
			]
		];;
		$compiler->addConfig(Helpers::merge($defaults, $config));
	});

	return new $class;
}
