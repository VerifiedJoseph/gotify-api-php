<?php

/**
 *  Code example for getting messages
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
    // Set server
    $server = new Gotify\Server('http://gotify.example.com/');

    // Set client token
    $auth = new Gotify\Auth\Token('TokenHere');

    // Create Message class instance
    $message = new Gotify\Endpoint\Message($server, $auth);

    $messages = $message->getAll();

    foreach ($messages->messages as $details) {
        echo 'Id: ' . $details->id . PHP_EOL;
        echo 'Date: ' . $details->date . PHP_EOL;
        echo 'Title: ' . $details->title . PHP_EOL;
        echo 'Message: ' . $details->message . PHP_EOL;
        echo 'Priority: ' . $details->priority . PHP_EOL;
        echo 'App Id: ' . $details->appid . PHP_EOL;
        echo PHP_EOL;
    }
} catch (EndpointException | GotifyException $err) {
    echo $err->getMessage();
}
