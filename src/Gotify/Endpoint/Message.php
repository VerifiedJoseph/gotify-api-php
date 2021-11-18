<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

/**
 * Class for interacting with Message API endpoint
 *
 * @see https://gotify.net/api-docs#/message API docs for message endpoint
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
	 * @return stdClass
	 *
	 * @see https://gotify.net/api-docs#/message/getMessages API docs for getting all messages
	 */
	public function getAll(int $limit = 100, int $since = 0): stdClass
	{
		$query = array(
			'limit' => $limit,
			'since' => $since
		);

		$response = $this->guzzle->get($this->endpoint, $query);
		$messages = Json::decode($response->getBody());

		return (object) $messages;
	}

	/**
	 * Create a message
	 *
	 * @param string $title	Message title
	 * @param string $message Message body
	 * @param int $priority Message priority
	 * @param array<string, array<string, array<string, mixed>>> $extras Message extras
	 *
	 * @return stdClass
	 *
	 * @see https://gotify.net/docs/msgextras Documentation for message extras
	 * @see https://github.com/gotify/android#message-priorities Message priority levels
	 * @see https://gotify.net/api-docs#/message/createMessage API docs for creating a message
	 */
	public function create(string $title, string $message, int $priority = 0, array $extras = array()): stdClass
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

		return (object) $message;
	}

	/**
	 * Delete a message
	 *
	 * @param int $id Message Id
	 * @return boolean
	 *
	 * @see https://gotify.net/api-docs#/message/deleteMessage API docs for deleting a message
	 */
	public function delete(int $id): bool
	{
		$response = $this->guzzle->delete($this->endpoint . '/' . $id);
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}

	/**
	 * Delete all messages
	 *
	 * @return boolean
	 *
	 * @see https://gotify.net/api-docs#/message/deleteMessages API docs for deleting all messages
	 */
	public function deleteAll(): bool
	{
		$response = $this->guzzle->delete($this->endpoint);
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}
}
