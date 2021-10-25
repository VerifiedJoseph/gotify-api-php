<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
		return $this->guzzle->get($this->endpoint);
	}
} 