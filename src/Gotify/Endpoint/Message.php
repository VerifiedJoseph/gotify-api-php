<?php

namespace Gotify\Endpoint;

Use Gotify\Api;
Use Gotify\Json;

/**
 * Class for interacting with Message API endpoint
 */
class Message extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'message';

	/**
	 * Get all messages (ordered by most recent)
	 *
	 * @param int $limit Maximum number of messages to return
	 * @param int $since Return all messages after a message id
	 *
	 * @return \stdClass
	 */
	public function getAll(int $limit = 100, int $since = 0)
	{
		$query = array(
			'limit' => $limit,
			'since' => $since
		);

		$response = $this->guzzle->get($this->endpoint, $query);
		$messages = Json::decode($response->getBody());

		return $messages;
	}

	/**
	 * Create a message
	 *
	 * @param string $title	Message title
	 * @param string $message Message body
	 * @param int $priority Message priority
	 * @param array<string, string> $extras Message extras
	 *
	 * @return \stdClass
	 */
	public function create(string $title, string $message, int $priority = 0, array $extras = array())
	{
		$data = array(
			'title' => $title,
			'message' => $message,
			'priority' => $priority
		);

		if (empty($extras) === false) {
			$data['extras'] = $extras;
		}

		$response = $this->guzzle->post($this->endpoint, $data);
		$message = Json::decode($response->getBody());

		return $message;
	}

	/**
	 * Delete a message
	 *
	 * @param int $id Message Id
	 *
	 * @return null
	 */
	public function delete(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id);
	}

	/**
	 * Delete all messages
	 *
	 * @return null
	 */
	public function deleteAll()
	{
		return $this->guzzle->delete($this->endpoint);
	}
}
