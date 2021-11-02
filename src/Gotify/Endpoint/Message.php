<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

/**
 * Class for interacting with Message API endpoint
 */
class Message extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'message';

	/**
	 * Get all messages
	 *
	 * @return \stdClass
	 */
	public function getAll()
	{
		return $this->guzzle->get($this->endpoint);
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

		return $this->guzzle->post($this->endpoint, $data);
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
