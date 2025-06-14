<?php

$pdo = new PDO('mysql:dbname=bench;host=mariadb', 'root', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL
)');

$pdo->exec("
INSERT INTO users (name, email) 
VALUES 
    ('Carlos lima', 'carlos.lima@teste.com'),
    ('Rubens Pereira', 'rubens.pereira@teste.com'),
    ('João Faria', 'joaofaria@teste.com'),
    ('Alberto Carmo', 'alberto@teste.com'),
    ('João del Castro', 'joao@teste.com')
");