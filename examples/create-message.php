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
	
	// Send a message
	$sentMessage = $message->create(
		'hello?', // Title
		'Hello World', // Message
		8 // Priority
	);
	
	// Dump sent message details
	var_dump($sentMessage);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
