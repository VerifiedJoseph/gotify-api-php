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
	 * @param string $token Authentication token
	 */
	final function __construct($server, $token = '')
	{
		$this->guzzle = new Guzzle($server, $token);
	}
}
