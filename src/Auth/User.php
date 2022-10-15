<?php

namespace Gotify\Auth;

use Gotify\Auth;

/**
 * Class for setting and validating username and password authentication
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
	public function get(): array
	{
		return array(
			'method' => $this->method,
			'username' => $this->username,
			'password' => $this->password
		);
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}
}
