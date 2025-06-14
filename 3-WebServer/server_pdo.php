<?php

ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;

$http = new HttpServer(function (ServerRequestInterface $request) {
    $pdo = new PDO('mysql:dbname=bench;host=mariadb', 'root', '123456');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM users WHERE id = 1 AND SLEEP(2) = 0');

    return Response::json($stmt->fetchAll(PDO::FETCH_OBJ));
});

$socket = new React\Socket\SocketServer('0.0.0.0:8080');
$http->listen($socket);

echo "Server running at http://0.0.0.0:8080" . PHP_EOL;