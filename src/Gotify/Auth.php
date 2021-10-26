<?php

namespace Gotify;

/**
 * Class for setting and vaildating authentication
 */
abstract class Auth
{
	/** @var string $method Authentication method */
	protected string $method = '';

	/**
	 * Get authentication
	 *
	 * @return string Returns array with auth method and values
	 */
	abstract public function get();
}
