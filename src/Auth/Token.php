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

    /**
     * Set authentication token
     *
     * @param string $token Authentication token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
