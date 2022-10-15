<?php

namespace Gotify\Auth;

use Gotify\Auth;

/**
 * Class for setting and validating an authentication token
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
	 * @return string
	 */
	public function getToken(): string
	{
		return $this->token;
	}
}
