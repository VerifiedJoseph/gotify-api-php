<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
		return $this->guzzle->get($this->endpoint);
	}
}
