<?php

/**
 * Code example for sending a message with message extras
 *
 * see: https://gotify.net/docs/msgextras
 */

include '../vendor/autoload.php';

use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;

use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

try {
	// Set server
	$server = new Server('https://gotify.example.com/');

	// Set application token
	$auth = new Token('TokenHere');

	// Create Message class instance
	$message = new Message($server, $auth);

	// Message extra for opening a URL on notification click.
	// https://gotify.net/docs/msgextras#clientnotification
	$extras = array(
		'client::notification' => array(
			'click' => array('url' => 'https://example.com/')
		)
	);

	// Send message and get details
	$sentMessage = $message->create(
		title: 'hello?',
		message: 'Hello World',
		priority: Message::PRIORITY_HIGH,
		extras: $extras
	);

	// Display sent message details
	echo 'Id: ' . $details->id . PHP_EOL;
	echo 'Date: ' . $details->date . PHP_EOL;
	echo 'Title: ' . $details->title . PHP_EOL;
	echo 'Message: ' . $details->message . PHP_EOL;
	echo 'Priority: ' . $details->priority . PHP_EOL;
	echo 'App Id: ' . $details->appid . PHP_EOL;

	echo 'Extras: ' . PHP_EOL;
	var_dump($details->extras);

} catch (EndpointException | GotifyException $err) {
	echo $err->getMessage();
}
