<?php

namespace Gotify;

Use Gotify\Guzzle;

/**
 * Class for interacting with the Gotify API using Guzzle
 */
abstract class Api
{
	/** @var Guzzle $guzzle Guzzle class instance */
	protected Guzzle $guzzle;

	/**
	 * Create Guzzle instance
	 *
	 * @param string $uri Server URI
	 * @param array $auth Authentication
	 */
	final function __construct(string $uri, array $auth = array())
	{
		$this->guzzle = new Guzzle($uri, $auth);
	}
}
