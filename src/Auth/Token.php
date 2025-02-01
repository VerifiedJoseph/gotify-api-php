<?php

declare(strict_types=1);

namespace Gotify\Auth;

/**
 * Class for setting and validating an authentication token
 */
class Token extends AbstractAuth
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
