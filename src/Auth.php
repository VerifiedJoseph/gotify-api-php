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
	 * Get authentication
	 *
	 * @return array<string, string> Returns array with auth method and values
	 */
	abstract public function get();
}
