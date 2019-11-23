<?php

$host = 'localhost';
$porta = '3306';
$dbname = 'desafio';

$user = 'root';
$senha = '';

$dsn = "mysql:host=$host:$porta;dbname=$dbname;charset=utf8mb4";
$dbc = new PDO($dsn, $user, $senha);