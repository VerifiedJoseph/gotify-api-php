<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

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
	 * @return stdClass
	 */
	public function getAll(int $id, int $limit = 100, int $since = 0): stdClass
	{
		$query = array(
			'limit' => $limit,
			'since' => $since
		);

		$response = $this->guzzle->get($this->endpoint . '/' . $id . '/message', $query);
		$messages = Json::decode($response->getBody());

		return (object) $messages;
	}

	/**
	 * Delete all messages for an application
	 *
	 * @param int $id Application Id
	 *
	 * @return boolean
	 */
	public function deleteAll(int $id): bool
	{
		$response = $this->guzzle->delete($this->endpoint . '/' . $id . '/message');
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}
}
