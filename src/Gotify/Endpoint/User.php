<?php

namespace Gotify\Endpoint;

use Gotify\Api;
use Gotify\Json;
use stdClass;

/**
 * Class for interacting with client user endpoint
 */
class User extends Api
{
	/** @var string $endpoint API endpoint */
	private string $endpoint = 'user';

	/**
	 * Get current user
	 *
	 * @return stdClass
	 */
	public function getCurrent(): stdClass
	{
		$response = $this->guzzle->get('current/user');
		$current = Json::decode($response->getBody());

		return (object) $current;
	}

	/**
	 * Update password for the current user
	 *
	 * @param string $password New password
	 *
	 * @return boolean
	 */
	public function updatePassword(string $password): bool
	{
		$data = array(
			'pass' => $password,
		);

		$response = $this->guzzle->post('current/user/password', $data);
		$body = $response->getBody()->getContents();

		if (empty($body) === true) {
			return true;
		}

		return false;
	}

	/**
	 * Get user
	 *
	 * @param int $id User Id
	 *
	 * @return stdClass
	 */
	public function getUser(int $id): stdClass
	{
		$response = $this->guzzle->get($this->endpoint . '/' . $id);
		$user = Json::decode($response->getBody());

		return (object) $user;
	}

	/**
	 * Get all users
	 *
	 * @return stdClass
	 */
	public function getAll(): stdClass
	{
		$response = $this->guzzle->get($this->endpoint);
		$users = Json::decode($response->getBody());

		return (object) ['users' => $users];
	}

	/**
	 * Create a user
	 *
	 * @param string $name Username
	 * @param string $password Password
	 * @param boolean $admin Admin status
	 *
	 * @return stdClass
	 */
	public function create(string $name, string $password, bool $admin = false): stdClass
	{
		$data = array(
			'name' => $name,
			'pass' => $password,
			'admin' => $admin
		);

		$response = $this->guzzle->post($this->endpoint, $data);
		$user = Json::decode($response->getBody());

		return (object) $user;
	}

	/**
	 * Delete a user
	 *
	 * @param int $id User Id
	 *
	 * @return boolean
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
}
