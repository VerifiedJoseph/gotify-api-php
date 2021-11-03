<?php

error_reporting(E_ERROR | E_PARSE);

$serverUri = getenv('GOTIFY_SERVER_URI');

$username = 'admin';
$password = 'admin';

try {
	createClient();

} catch (Exception $err) {
	output($err->getMessage());
	exit(1);
}

function createClient() {
	global $serverUri, $username, $password;

	output('Creating client');

	$data = array(
		'name' => 'Github action'
	);

	$output = null;

	// Replace this with cURL
	exec('curl -u '. $username .':'. $password .' ' . $serverUri . '/client -F "name=test"', $output);
	$client = json_decode($output[0]);

	if ($client === null) {
		throw new Exception('JSON decoding failed');
	}

	if (isset($client->error)) {
		throw new Exception('Gotify API error: ' . $client->errorDescription);
	}

	output('Client: ' . $client->id);

	writeFile('clientId.json', $output[0]);
}

function writeFile(string $path, string $data) {
	if (file_put_contents($path, $data) === false) {
		throw new Exception('Failed to write file: ' .  $path);
	}

	output('Create file: ' . $path);
}

function output($text) {
	echo $text . " \n";
}
