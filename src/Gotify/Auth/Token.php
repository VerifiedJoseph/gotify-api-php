<?php

namespace Gotify\Auth;

use Gotify\Auth;

/**
 * Class for setting and vaildating an authentication token
 */
class Token extends Auth
{
	/** @var string $method Authentication method */
	protected string $method = 'token';

	/** @var string $token Authentication token */
	protected string $token = '';

	/**
	 * Set authentication token
	 *
	 * @param string $token Authentication token
	 */
	function __construct(string $token)
	{
		$this->token = $token;
	}

	/**
	 * Get authentication token
	 *
	 * @return array Returns array with auth method and token
	 */
	public function get()
	{
		return array(
			'method' => $this->method,
			'token' => $this->token
		);
	}
}
