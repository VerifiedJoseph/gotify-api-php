<?php

namespace Gotify\Auth;

use Gotify\Auth;

/**
 * Class for setting and vaildating username and password authentication
 */
class User extends Auth
{
	/** @var string $method Authentication method */
	protected string $method = 'user';

	/** @var string $username Username */
	private string $username = '';

	/** @var string $password Password */
	private string $password = '';

	/**
	 * Set username and password
	 *
	 * @param string $username Username
	 * @param string $password Password
	 */
	function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * Get authentication
	 *
	 * @return array<string, string> Returns array with method, username and password
	 */
	public function get()
	{
		return array(
			'method' => $this->method,
			'username' => $this->username,
			'password' => $this->password
		);
	}
}
