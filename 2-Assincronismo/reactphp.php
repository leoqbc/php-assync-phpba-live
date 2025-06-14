<?php

require __DIR__ . '/vendor/autoload.php';


use React\Http\Browser;
use Psr\Http\Message\ResponseInterface;

$client = new Browser();

$urls = [
    'https://httpbin.org/get',
    'https://httpbin.org/delay/2',
    'https://jsonplaceholder.typicode.com/posts/1'
];

$promises = [];

foreach ($urls as $url) {
    $client->get($url)->then(function (ResponseInterface $response) use ($url) {
            echo "✅ $url\n";
            echo "Status: " . $response->getStatusCode() . "\n";
            echo substr($response->getBody()->getContents(), 0, 300) . "\n\n";
        }, function (Exception $e) use ($url) {
            echo "❌ Erro em $url: " . $e->getMessage() . "\n\n";
        }
    );
}
