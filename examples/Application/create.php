<?php

/**
 * 	Code example for creating an application
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Set client token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create Application class instance
	$application = new Gotify\Endpoint\Application($server, $auth);

	// Create an application and get its details
	$details = $application->create(
		name: 'Test app',
		description: 'A test app'
	);

	// Display application details
	echo 'Id: ' . $details->id . PHP_EOL;
	echo 'Name: ' . $details->name . PHP_EOL;
	echo 'Description: ' . $details->description . PHP_EOL;
	echo 'Token: ' . $details->token . PHP_EOL;

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
