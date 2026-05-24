<?php

require('./config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);
$currentday = $data['currentday'];
$futureday = $data['futureday'];
$mockday = '2026-01-01';
$api = $_ENV['API_KEY'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://sports.bzzoiro.com/api/events/?league=27&date_from=$currentday&date_to=$futureday");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Token $api"]);

$server_response = curl_exec($ch);

curl_close($ch);

echo $server_response;
