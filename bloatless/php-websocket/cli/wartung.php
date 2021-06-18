<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../src/Client.php';

$client = new \Bloatless\WebSocket\Client;
$client->connect('127.0.0.1', 8100, '/demo', 'foo.lh');

usleep(5000);

$payload = json_encode([
    'action' => 'echo',
    'data' => '                In Kürze verbessern wir Abalo für Sie!
               Nach einer kurzen Pause sind wir wieder
                           für Sie da! Versprochen.
',

]);
$client->sendData($payload);
//usleep(5000);

