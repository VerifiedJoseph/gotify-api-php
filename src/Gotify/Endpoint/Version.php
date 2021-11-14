<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;

/**
 * Class for interacting with version API endpoint
 */
class Version extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'version';

	/**
	 * Get version information
	 *
	 * @return \stdClass
	 */
	public function get()
	{
		$response = $this->guzzle->get($this->endpoint);
		$version = Json::decode($response->getBody());

		return (object) $version;
	}
}
