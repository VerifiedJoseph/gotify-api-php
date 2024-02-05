<?php

use Gotify\Auth\User;
use Gotify\Auth\Token;

class AuthTest extends AbstractTestCase
{
    /**
     * Test Auth\User
     */
    public function testUser(): void
    {
        $method = 'user';
        $username = 'username';
        $password = 'password';

        $auth = new User($username, $password);

        $this->assertEquals($method, $auth->getAuthMethod());
        $this->assertEquals($username, $auth->getUsername());
        $this->assertEquals($password, $auth->getPassword());
    }

    /**
     * Test Auth\Token
     */
    public function testToken(): void
    {
        $method = 'token';
        $token = 'TokenHere';

        $auth = new Token($token);

        $this->assertEquals($method, $auth->getAuthMethod());
        $this->assertEquals($token, $auth->getToken());
    }
}
