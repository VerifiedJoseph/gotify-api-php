<?php

namespace Gotify\Endpoint;

Use Gotify\Api;
Use Gotify\Json;

/**
 * Class for interacting with health API endpoint
 */
class Health extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'health';

	/**
	 * Get health information
	 *
	 * @return \stdClass
	 */
	public function get()
	{
		$response = $this->guzzle->get($this->endpoint);
		$health = Json::decode($response->getBody());

		return (object) $health;
	}
}
