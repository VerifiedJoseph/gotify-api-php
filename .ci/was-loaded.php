<?php

include '/home/runner/vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('http://127.0.0.1:8080');

	// Set application token
	$auth = new Gotify\Auth\User('admin', 'admin');

	$plugin = new Gotify\Endpoint\Plugin(
		$server->get(),
		$auth->get()
	);

	var_dump($plugin->getAll());

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
