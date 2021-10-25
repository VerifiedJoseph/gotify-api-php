<?php

namespace Gotify;

/**
 * Class for setting and vaildating an authentication token
 */
final class Token
{
	/** @var string $token Authentication token */
	private string $token = '';

	/**
	 * 
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
	 * @return string Returns token
	 */
	public function get()
	{
		return $this->token;
	}
} 