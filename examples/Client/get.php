<?php

/**
 * 	Code example for getting a list of clients
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('http://gotify.example.com/');

	// Set client token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create Client class instance
	$client = new Gotify\Endpoint\Client(
		$server->get(),
		$auth->get()
	);

	$clients = $client->getAll();

	foreach ($clients->clients as $details) {
		echo 'Id: ' . $details->id . PHP_EOL;
		echo 'Name: ' . $details->name . PHP_EOL;
		echo 'Token: ' . $details->token . PHP_EOL;
		echo PHP_EOL;
	}

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
