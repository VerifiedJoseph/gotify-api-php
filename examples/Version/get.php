<?php

/**
 * 	Code example for getting server version details
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Create Version class instance
	$version = new Gotify\Endpoint\Version($server);

	// Get version details
	$details = $version->get();

	echo 'Version: ' . $details->version . PHP_EOL;
	echo 'Commit: ' . $details->commit . PHP_EOL;
	echo 'Build date: ' . $details->buildDate . PHP_EOL;

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
