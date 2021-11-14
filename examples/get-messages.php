<?php

/**
 * 	Code example for getting messages
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
	$message = new Gotify\Endpoint\Message(
		$server->get(),
		$auth->get()
	);

	$messages = $message->getAll();

	foreach ($messages->messages as $m) {
		var_dump($m);
	}

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
