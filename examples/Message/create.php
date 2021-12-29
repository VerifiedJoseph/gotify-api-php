<?php

/**
 * 	Code example for sending a message
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Set application token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create Message class instance
	$message = new Gotify\Endpoint\Message(
		$server->get(),
		$auth->get()
	);

	// Send message and get details
	$details = $message->create(
		title: 'hello?',
		message: 'Hello World',
		priority: 8,
	);

	// Dsiplay sent message details
	echo 'Id: ' . $details->id . PHP_EOL;
	echo 'Date: ' . $details->date . PHP_EOL;
	echo 'Title: ' . $details->title . PHP_EOL;
	echo 'Message: ' . $details->message . PHP_EOL;
	echo 'Priority: ' . $details->priority . PHP_EOL;
	echo 'App Id: ' . $details->appid . PHP_EOL;

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
