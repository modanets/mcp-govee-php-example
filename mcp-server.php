#!/usr/bin/env php
<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use PhpMcp\Server\Server;
use PhpMcp\Server\Transports\StdioServerTransport;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

try {
    $server = Server::make()
        ->withServerInfo('Light Control Server', '1.0.0')
        ->build();

    $server->discover(basePath: __DIR__, scanDirs: ['src/Tools']);

    $transport = new StdioServerTransport();
    $server->listen($transport);
} catch (\Throwable $e) {
    fwrite(STDERR, "[ERROR] " . $e->getMessage() . "\n");
    exit(1);
}
