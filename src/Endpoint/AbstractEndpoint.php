<?php

declare(strict_types=1);

namespace Gotify\Endpoint;

use Gotify\Server;
use Gotify\Guzzle;
use Gotify\Auth\User;
use Gotify\Auth\Token;

/**
 * Class for interacting with the Gotify API using Guzzle
 */
abstract class AbstractEndpoint
{
    /** @var Guzzle $guzzle Guzzle class instance */
    protected Guzzle $guzzle;

    /**
     * @param Server $server Server URI
     * @param null|User|Token $auth Authentication class instance
     */
    final public function __construct(Server $server, null|User|Token $auth = null)
    {
        $this->guzzle = new Guzzle($server->get(), $auth);
    }
}
