<?php

namespace Rostenkowski\Console\Command;


use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Utils\Strings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugRouter extends Command
{

	private $router;


	public function __construct(IRouter $router = NULL)
	{
		$this->setDescription('Display debug information about routes.');
		if ($router !== NULL) {
			$this->router = $router;
		}

		parent::__construct('nette:debug-router');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if ($this->router) {
			$style = new OutputFormatterStyle('white', 'default', ['bold']);
			$output->getFormatter()->setStyle('i', $style);
			$table = new Table($output);
			$table->setHeaders(['Type', 'Mask', 'Target', 'Defaults']);
			$this->renderRouter($table, $this->router);
			$table->render();
		} else {
			$output->writeln('No router service configured');
		}
	}


	private function renderRouter(Table $table, IRouter $router)
	{
		if ($router instanceof RouteList) {
			foreach ($router as $route) {
				$this->renderRouter($table, $route);
			}
		} else {
			$defaults = $router->getDefaults();
			$mask = $router instanceof Route ? $router->getMask() : '';
			$table->addRow([get_class($router), $mask, "$defaults[presenter]:$defaults[action]", $this->getDefaults($router)]);
		}
	}


	private function getDefaults(IRouter $router)
	{
		$defaults = array_filter($router->getDefaults(), function ($key) {
			return !in_array($key, ['presenter', 'action']);
		}, ARRAY_FILTER_USE_KEY);

		$result = '';
		foreach ($defaults as $key => $val) {
			$result .= "$key: $val" . PHP_EOL;
		}

		return Strings::substring($result, 0, -1);
	}

}
