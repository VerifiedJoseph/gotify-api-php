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
	$application = new Gotify\Endpoint\Application($server, $auth);

	$apps = $application->getAll();

	foreach ($apps->apps as $details) {
		echo 'Id: ' . $details->id . PHP_EOL;
		echo 'Name: ' . $details->name . PHP_EOL;
		echo 'Description: ' . $details->description . PHP_EOL;
		echo 'Token: ' . $details->token . PHP_EOL;
		echo PHP_EOL;
	}

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
