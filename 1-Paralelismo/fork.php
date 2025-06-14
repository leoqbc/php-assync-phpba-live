<?php

if (!function_exists('pcntl_fork')) {
    die("pcntl_fork não está disponível. Ative a extensão pcntl no PHP.\n");
}

$pid = pcntl_fork();

if ($pid == -1) {
    // Erro ao criar processo filho
    die("Erro ao criar processo filho.\n");

} elseif ($pid === 0) {
    // Processo filho
    echo "Processo filho iniciado. PID: " . getmypid() . "\n";
    sleep(2);
    echo "Processo filho finalizado.\n";
    exit(0);

} else {
    // Processo pai
    echo "Processo pai. PID: " . getmypid() . ", filho PID: $pid\n";
    pcntl_wait($status);
    echo "Processo pai: filho terminou com status $status\n";
}