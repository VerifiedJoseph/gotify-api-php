<?php

declare(strict_types=1);

namespace Gotify\Auth;

/**
 * Class for setting and validating authentication
 */
abstract class AbstractAuth
{
    /** @var string $method Authentication method */
    protected string $method = '';

    /** @var string $token Authentication token */
    protected string $token = '';

    /** @var string $username Username */
    protected string $username = '';

    /** @var string $password Password */
    protected string $password = '';

    /**
     * Get authentication method
     *
     * @return string
     */
    final public function getAuthMethod(): string
    {
        return $this->method;
    }

    /**
     * Get authentication token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
