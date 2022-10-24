<?php

/**
 * 	Code example for creating a user
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Set client token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create User class instance
	$user = new Gotify\Endpoint\User($server, $auth);

	// Create a user and get its details
	$details = $user->create(
		name: 'Bob',
		password: 'BobPassword1',
		admin: false,
	);

	// Display user details
	echo 'Id: ' . $details->name . PHP_EOL;
	echo 'Username: ' . $details->name . PHP_EOL;
	echo 'Is admin: ' . $details->admin . PHP_EOL;

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
