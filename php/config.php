<?php

    require "../vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = 'localhost';
    $user = 'xsqcijsd';
    $password = 'w!Tje4P44Hor6Xce(y';
    $dbname = 'xsqcijsd_users';

    $dsn = "mysql:host=$host;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);
