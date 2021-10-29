<?php

/**
 * 	Code example for gettting server version details
 */

include 'vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');
	
	// Create Version class instance
	$version = new Gotify\Endpoint\Version(
		$server->get()
	);
	
	// Get version details
	var_dump($version->get());

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
