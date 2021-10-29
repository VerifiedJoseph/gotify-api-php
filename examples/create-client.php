<?php

/**
 * 	Code example for creating a client
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Set username & password
	$auth = new Gotify\Auth\User(
		'username',
		'password'
	);
	
	// Create Client class instance
	$client = new Gotify\Endpoint\Client(
		$server->get(),
		$auth->get()
	);
	
	// Create a client and get its details
	$createdClient = $client->create('Example client name');

	// Dump client details
	var_dump($createdClient);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
