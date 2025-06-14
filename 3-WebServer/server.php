<?php

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;

$http = new HttpServer(function (ServerRequestInterface $request) {
    return Response::plaintext('Hello World!');
});

$socket = new React\Socket\SocketServer('0.0.0.0:8080');
$http->listen($socket);

echo "Server running at http://0.0.0.0:8080" . PHP_EOL;