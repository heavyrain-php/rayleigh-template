#!/usr/bin/env php
<?php declare(strict_types=1);

/**
 * @license MIT
 */

require_once __DIR__ . '/vendor/autoload.php';

$application = new \Rayleigh\Application\Application();

exit((new Rayleigh\Console\ConsoleHandler($application))->handle());
