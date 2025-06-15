<?php

ini_set('memory_limit', '512M');

use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

require __DIR__ . '/vendor/autoload.php';

run(function () {
    $pdoConfig = new \Swoole\Database\PDOConfig()
        ->withHost('mariadb')
        ->withDbname('bench')
        ->withUsername('root')
        ->withPassword('123456')
    ;

    $pool = new \Swoole\Database\PDOPool($pdoConfig, 50);

    $pdo = $pool->get();
    // Limpa a tabela
    $pdo->exec("TRUNCATE TABLE users");
    $pool->put($pdo);
    $executions = 0;
    while ($executions < 15) {
        for ($i = 0; $i < 1500; $i++) {
            $faker = new Faker\Factory()->create();
            $name = $faker->name();
            $email = $faker->email();
            go(function () use ($pool, $name, $email) {
                $pdo = $pool->get();

                $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                $stmt->execute([$name, $email]);

                $pool->put($pdo);
            });
        }
        $executions++;
        usleep(50_000);
    }
});

echo 'Total de memoria usada: ' . (round(memory_get_peak_usage() / 1024 / 1024, 2)) . 'MB' . PHP_EOL;
