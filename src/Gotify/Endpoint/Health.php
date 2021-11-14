<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

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
	 * @return stdClass
	 */
	public function get(): stdClass
	{
		$response = $this->guzzle->get($this->endpoint);
		$health = Json::decode($response->getBody());

		return (object) $health;
	}
}
