<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
		return $this->guzzle->get($this->endpoint);
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

		return $this->guzzle->post($this->endpoint, $data);
	}

	/**
	 * Update a client
	 *
	 * @param string $id Client Id
	 * @param string $name New client name
	 *
	 * @return \stdClass
	 */
	public function update(int $id, string $name)
	{
		$data = array(
			'name' => $name,
		);

		return $this->guzzle->put($this->endpoint . '/' . $id, $data);
	}

	/**
	 * Delete a client
	 *
	 * @param string $id Client Id
	 *
	 * @return \stdClass|null
	 */
	public function delete(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id);
	}
}
