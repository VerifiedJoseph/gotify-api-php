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
	$user = new Gotify\Endpoint\User(
		$server->get(),
		$auth->get()
	);

	// Create a user and get its details
	$createduser = $user->create(
		name: 'Bob',
		password: 'BobPassword1',
		admin: false,
	);

	// Dump user details
	var_dump($createduser);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
