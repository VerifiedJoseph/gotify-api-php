<?php

namespace Gotify;

Use Gotify\Server;
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
	 * @param Server $server Server URI
	 * @param ?Auth $auth Authentication
	 */
	final function __construct(Server $server, ?Auth $auth = null)
	{
		$this->guzzle = new Guzzle($server->get(), $auth);
	}
}
