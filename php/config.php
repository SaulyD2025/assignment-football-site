<?php

    require "../vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = 'localhost';
    $user = 'xsqcijsd';
    $password = '.R6hjdR26p1K(D';
    $dbname = 'xsqcijsd_users';

    $dsn = "mysql:host=$host;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);
