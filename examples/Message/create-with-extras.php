<?php

/**
 * Code example for sending a message with message extras
 *
 * see: https://gotify.net/docs/msgextras
 */

include '../vendor/autoload.php';

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Gotify\Server('https://gotify.example.com/');

	// Set application token
	$auth = new Gotify\Auth\Token('TokenHere');

	// Create Message class instance
	$message = new Gotify\Endpoint\Message(
		$server->get(),
		$auth->get()
	);

	// Message extra for opening a URL on notification click.
	// https://gotify.net/docs/msgextras#clientnotification
	$extras = array(
		'client::notification' => array(
			'click' => array('url' => 'https://example.com/')
		)
	);

	// Send a message
	$sentMessage = $message->create(
		title: 'hello?',
		message: 'Hello World',
		priority: 8,
		extras: $extras
	);

	// Dump sent message details
	var_dump($sentMessage);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
