<?php

namespace Rostenkowski\Console;


use Nette\DI\CompilerExtension;
use Nette\DI\Helpers;
use Nette\PhpGenerator;
use Rostenkowski\Console\Command\DebugRouter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class Extension extends CompilerExtension
{

	protected $defaults = [
		'debugMode' => '%debugMode%',
		'class'     => Application::class,
		'name'      => 'app console',
		'version'   => '1.0.0',
		'commands'  => [
			'debug:router' => DebugRouter::class
		],
	];


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		// expand options
		$config = Helpers::expand($this->validateConfig($this->defaults, $this->getConfig()), $builder->parameters);

		// create console
		$console = $builder->addDefinition('console')
			->setClass($config['class'])
			->addSetup('setCatchExceptions', [$config['debugMode']])
			->addSetup('setName', [$config['name']])
			->addSetup('setVersion', [$config['version']]);

		// add commands
		foreach ($config['commands'] as $name => $class) {

			// remove backslashes from the class name
			$serviceName = preg_replace('/\\\\/', '', $class);

			// create command
			$command = $builder->addDefinition($this->prefix($serviceName));
			$command->setFactory($class);
			$command->addSetup('setName', [$name]);

			// add command to console
			$console->addSetup('add', [$this->prefix("@$serviceName")]);
		}
	}


	public function afterCompile(PhpGenerator\ClassType $class)
	{
		// add all commands defined as services
		$builder = $this->getContainerBuilder();
		$console = $builder->getDefinition($builder->getByType(Application::class));
		foreach ($builder->findByType(Command::class) as $name => $definition) {

			// already registered commands are marked with console tag
			if (!$definition->getTag('console')) {
				$console->addSetup('add', ['@name']);
			}
		}
	}


}
