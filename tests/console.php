#!/usr/bin/env php
<?php declare(strict_types=1);

namespace Rostenkowski\Console;


use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/container.php';

umask(0002);

define('TEMP_DIR', __DIR__ . '/temp');

$container = container(false);
/** @var Application $app */
$app = $container->getByType(Application::class);
$app->run();
