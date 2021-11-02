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
	output('Creating client');

	$data = array(
		'name' => 'Github action'
	);

	$response = MakePostRequest('client', $data);
	if ($response === false) {
		throw new Exception('Request to client endpoint failed');
	}

	$client = json_decode($response);

	if (isset($client->error)) {
		throw new Exception('Gotify API error: ' . $client->errorDescription);
	}

	output('Client: ' . $client->id);

	writeFile('clientId.json', $response);
}

function MakePostRequest(string $endpoint, array $data) {
	global $serverUri, $username, $password;

	$content = json_encode($data);

	$auth = base64_encode($username . ':' . $password);
	$context = stream_context_create([
    	'http' => [
			'header' => 'Authorization: Basic '. $auth,
			'method'  => 'POST',
				'header'  => 'Content-Type: application/json',
				'content' => $content
    	]
	]);

	$response = file_get_contents($serverUri . '/' . $endpoint, false, $context);

	if ($response === false) {
		throw new Exception('Request to client endpoint failed');
	}

	return $response;
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
