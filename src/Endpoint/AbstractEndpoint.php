<?php

namespace Gotify\Endpoint;

use Gotify\Auth;
use Gotify\Server;
use Gotify\Guzzle;

/**
 * Class for interacting with the Gotify API using Guzzle
 */
abstract class AbstractEndpoint
{
    /** @var Guzzle $guzzle Guzzle class instance */
    protected Guzzle $guzzle;

    /**
     * Create Guzzle instance
     *
     * @param Server $server Server URI
     * @param ?Auth $auth Authentication
     */
    final public function __construct(Server $server, ?Auth $auth = null)
    {
        $this->guzzle = new Guzzle($server->get(), $auth);
    }
}
