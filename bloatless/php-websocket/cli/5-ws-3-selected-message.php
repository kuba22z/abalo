<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../src/Client.php';

    $client = new \Bloatless\WebSocket\Client;
    $client->connect('127.0.0.1', 8100, '/demo', 'foo.lh');

usleep(5000);

$payload = json_encode([
    'action' => 'echo',
    'data' => json_encode([
        'text' => 'Hallo Welt',
        'id' => '3',
    ]),
]);

$payload2 = json_encode([
    'action' => 'echo',
    'data' => json_encode([
        'text' => 'Geheim und nur für 2',
        'id' => '2',
    ]),
]);
    $client->sendData($payload);
    $client->sendData($payload2);
    //usleep(5000);

