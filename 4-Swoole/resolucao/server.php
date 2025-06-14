<?php

require __DIR__ . '/vendor/autoload.php';

use Swoole\Http\Server;
use Swoole\Constant;

\Swoole\Runtime::enableCoroutine();

$server = new Server('0.0.0.0', 8080, SWOOLE_BASE);

$server->set([
    'worker_num' => 1
]);

$server->on(Constant::EVENT_START, function ($server) {
    echo "Swoole http server is started at http://0.0.0.0:8080" . PHP_EOL;
});

$server->on(Constant::EVENT_REQUEST, function ($request, $response) {
    $pdo = new PDO('mysql:dbname=bench;host=mariadb', 'root', '123456');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);

    $stmt = $pdo->query('SELECT * FROM users WHERE id = 1 AND SLEEP(2) = 0');

    $response->end(json_encode($stmt->fetchAll(PDO::FETCH_OBJ)));
});

$server->start();