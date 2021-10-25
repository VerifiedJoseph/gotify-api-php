<?php

namespace Gotify\Endpoint;

Use Gotify\Api;

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
	 * @return \stdClass
	 */
	public function getCurrent()
	{
		return $this->guzzle->get('current/user');
	}

	/**
	 * Update password for the current user
	 *
	 * @param string $name New password
	 *
	 * @return null
	 */
	public function updatePassword(string $password)
	{
		$data = array(
			'pass' => $password,
		);

		return $this->guzzle->post('current/user/password', $data);
	}

	/**
	 * Get user
	 *
	 * @param int $id User Id
	 *
	 * @return \stdClass
	 */
	public function getUser(int $id)
	{
		return $this->guzzle->get($this->endpoint . '/' . $id);
	}

	/**
	 * Get all users
	 *
	 * @return \stdClass
	 */
	public function getUsers()
	{
		return $this->guzzle->get($this->endpoint);
	}

	/**
	 * Create a user
	 *
	 * @param string $name Username
	 * @param string $password Password
	 * @param boolean $admin Admin status
	 *
	 * @return \stdClass
	 */
	public function create(string $name, string $password, bool $admin = false)
	{
		$data = array(
			'name' => $name,
			'pass' => $password,
			'admin' => $admin
		);

		return $this->guzzle->post($this->endpoint, $data);
	}

	/**
	 * Delete a user
	 *
	 * @param string $id User Id
	 *
	 * @return null
	 */
	public function delete(int $id)
	{
		return $this->guzzle->delete($this->endpoint . '/' . $id);
	}
}
