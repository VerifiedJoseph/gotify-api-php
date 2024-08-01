<?php

namespace Tests\Auth;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\AbstractTestCase;
use Gotify\Auth\User;
use Gotify\Auth\AbstractAuth;

#[CoversClass(User::class)]
#[CoversClass(AbstractAuth::class)]
class UserTest extends AbstractTestCase
{
    private string $method = 'user';
    private string $username = 'username';
    private string $password = 'password';

    /**
     * Test `getAuthMethod()`
     */
    public function testGetAuthMethod(): void
    {
        $auth = new User($this->username, $this->password);
        $this->assertEquals($this->method, $auth->getAuthMethod());
    }

    /**
     * Test `getUsername()`
     */
    public function testGetUsername(): void
    {
        $auth = new User($this->username, $this->password);
        $this->assertEquals($this->username, $auth->getUsername());
    }

    /**
     * Test `getPassword()`
     */
    public function testGetPassword(): void
    {
        $auth = new User($this->username, $this->password);
        $this->assertEquals($this->password, $auth->getPassword());
    }
}
