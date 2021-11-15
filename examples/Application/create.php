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
	$application = new Gotify\Endpoint\Application(
		$server->get(),
		$auth->get()
	);

	// Create an application and get its details
	$createdApp = $application->create(
		'Application name',
		'Application description'
	);

	// Dump application details
	var_dump($createdApp);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
