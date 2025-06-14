<?php

$urls = [
    'https://httpbin.org/get',
    'https://httpbin.org/delay/2',
    'https://jsonplaceholder.typicode.com/posts/1'
];

foreach ($urls as $url) {
    $fopen = fopen($url, 'r');
    echo '=============' . PHP_EOL;
    echo fread($fopen, 1024);
    fclose($fopen);
}