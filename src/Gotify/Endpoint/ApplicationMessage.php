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
	 * Get all messages for an application (ordered by most recent)
	 *
	 * @param int $id Application Id
	 * @param int $limit Maximum number of messages to return
	 * @param int $since Return all messages after a message id
	 *
	 * @return \stdClass
	 */
	public function getAll(int $id, int $limit = 100, int $since = 0)
	{
		$query = array(
			'limit' => $limit,
			'since' => $since
		);

		return $this->guzzle->get($this->endpoint . '/' . $id . '/message', $query);
	}

	/**
	 * Delete all messages for an application
	 *
	 * @param int $id Application Id
	 *
	 * @return null
	 */
	public function deleteAll(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id . '/message');
	}
}
