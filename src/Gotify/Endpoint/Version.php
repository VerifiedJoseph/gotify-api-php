<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

/**
 * Class for interacting with the version API endpoint
 *
 * @see https://gotify.net/api-docs#/version API docs for the version endpoint
 */
class Version extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'version';

	/**
	 * Get version information
	 *
	 * @return stdClass
	 *
	 * @see https://gotify.net/api-docs#/version/getVersion API docs for getting version information
	 */
	public function get(): stdClass
	{
		$response = $this->guzzle->get($this->endpoint);
		$version = Json::decode($response->getBody());

		return (object) $version;
	}
}
