<?php declare(strict_types=1);

/**
 * @license MIT
 */

use Amp\Http\HttpStatus;
use Amp\Http\Server\DefaultErrorHandler;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Http\Server\Response;
use Monolog\Logger;
use Rayleigh\Config\ArrayConfig;
use Rayleigh\Http\HttpConfig;
use Rayleigh\Http\HttpHandler;

use function Amp\trapSignal;

require_once __DIR__ . '/../vendor/autoload.php';

$appName = 'Rayleigh';
$logger = new Logger($appName);
$requestHandler = new class() implements RequestHandler {
    public function handleRequest(Request $request) : Response
    {
        return new Response(
            status: HttpStatus::OK,
            headers: ['Content-Type' => 'text/plain'],
            body: 'Hello, world!',
        );
    }
};
$errorHandler = new DefaultErrorHandler();
$config = new HttpConfig(new ArrayConfig([
]));
$handler = new HttpHandler(
    $logger,
    $requestHandler,
    $errorHandler,
    $config,
);

$server = $handler->listen();

// wait until SIGINT or SIGTERM is received
$signalCode = trapSignal([\SIGINT, \SIGTERM]);

// stop server gracefully
$server->stop();

exit($signalCode);
