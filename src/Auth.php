<?php

namespace Gotify;

/**
 * Class for setting and validating authentication
 */
abstract class Auth
{
	/** @var string $method Authentication method */
	protected string $method = '';

	/**
	 * Get authentication method
	 *
	 * @return string
	 */
	final public function getAuthMethod(): string
	{
		return $this->method;
	}
}
