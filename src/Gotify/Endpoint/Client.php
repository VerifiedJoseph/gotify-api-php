<?php

namespace Gotify\Endpoint;

Use Gotify\Api;
Use Gotify\Json;

/**
 * Class for interacting with client API endpoint
 */
class Client extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'client';

	/**
	 * Get all clients
	 *
	 * @return \stdClass
	 */
	public function getAll()
	{
		$response = $this->guzzle->get($this->endpoint);
		$clients = Json::decode($response->getBody());

		return (object) ['clients' => $clients];
	}

	/**
	 * Create a client
	 *
	 * @param string $name Client name
	 *
	 * @return \stdClass
	 */
	public function create(string $name)
	{
		$data = array(
			'name' => $name,
		);

		$response = $this->guzzle->post($this->endpoint, $data);
		$client = Json::decode($response->getBody());

		return (object) $client;
	}

	/**
	 * Update a client
	 *
	 * @param int $id Client Id
	 * @param string $name New client name
	 *
	 * @return \stdClass
	 */
	public function update(int $id, string $name)
	{
		$data = array(
			'name' => $name,
		);

		$response = $this->guzzle->put($this->endpoint . '/' . $id, $data);
		$client = Json::decode($response->getBody());

		return (object) $client;
	}

	/**
	 * Delete a client
	 *
	 * @param int $id Client Id
	 * 
	 * @return boolean
	 */
	public function delete(int $id)
	{
		$response = $this->guzzle->delete($this->endpoint . '/' . $id);
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}
}
