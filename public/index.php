<?php declare(strict_types=1);

/**
 * @license MIT
 */

use Amp\Http\Server\DefaultErrorHandler;
use Amp\Http\Server\ErrorHandler;
use Amp\Http\Server\RequestHandler as RequestHandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Rayleigh\Config\ArrayConfig;
use Rayleigh\Container\Container;
use Rayleigh\Contracts\Config;
use Rayleigh\Http\HttpHandler;
use Rayleigh\Http\RequestHandler;

use function Amp\ByteStream\getStdout;
use function Amp\trapSignal;

require_once __DIR__ . '/../vendor/autoload.php';

$config = new ArrayConfig([
    'app.name' => 'Rayleigh',

    'http.exposes' => '0.0.0.0:8080',
    'http.useProxy' => 'false',
    'http.forwardedHeaderType' => 'x-forwarded-for',
    'http.trustedProxies' => '0.0.0.0/0',
    'http.enableCompression' => 'true',
    'http.connecitonLimit' => '1000',
    'http.connecitonLimitPerIp' => '10',
    'http.concurrencyLimit' => '1000',
    'http.allowedMethods' => 'GET,POST,PUT,DELETE,PATCH,OPTIONS',
]);
$container = new Container();
$logger = new Logger($config->getString('app.name'));
$logger->pushHandler(new StreamHandler(getStdout()));

$container->bind(LoggerInterface::class, $logger);
$container->bind(RequestHandlerInterface::class, RequestHandler::class);
$container->bind(ErrorHandler::class, DefaultErrorHandler::class);
$container->bind(Config::class, $config);

$server = $container->get(HttpHandler::class)->listen();

// wait until SIGINT or SIGTERM is received
$signalCode = trapSignal([\SIGINT, \SIGTERM]);

$logger->info('Received signal ' . $signalCode . ', shutting down...');

// stop server gracefully
$server->stop();
