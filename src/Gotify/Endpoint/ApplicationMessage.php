<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

/**
 * Class for interacting with Application message API endpoint
 */
class ApplicationMessage extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'application';

	/**
	 * Get all messages for an application
	 *
	 * @param string $id Application Id
	 *
	 * @return \stdClass
	 */
	public function getAll(int $id)
	{
		return $this->guzzle->get($this->endpoint . '/' . $id . '/message');
	}

	/**
	 * Delete all messages for an application
	 *
	 * @param string $id Application Id
	 *
	 * @return null
	 */
	public function deleteAll(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id . '/message');
	}
}
