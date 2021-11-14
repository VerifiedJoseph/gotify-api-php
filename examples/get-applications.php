<?php

/**
 * 	Code example for getting a list of applications
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('http://gotify.example.com/');

	// Set client token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create Application class instance
	$application = new Gotify\Endpoint\Application(
		$server->get(),
		$auth->get()
	);

	$apps = $application->getAll();

	foreach ($apps->apps as $app) {
		var_dump($app);
	}

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
