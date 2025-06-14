<?php

ini_set('memory_limit', '512M');

use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

require __DIR__ . '/vendor/autoload.php';


$pdo = new PDO('mysql:dbname=bench;host=mariadb', 'root', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Limpa a tabela
$pdo->exec("TRUNCATE TABLE users");

$faker = new Faker\Factory()->create();

for ($i = 0; $i < 30000; $i++) {
    $name = $faker->name;
    $email = $faker->email;

    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute([$name, $email]);
}

echo 'Total de memoria usada: ' . (round(memory_get_peak_usage() / 1024, 2)) . PHP_EOL;
