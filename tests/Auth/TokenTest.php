<?php

namespace Tests\Auth;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\AbstractTestCase;
use Gotify\Auth\Token;

#[CoversClass(Token::class)]
#[CoversClass(\Gotify\Auth::class)]
class TokenTest extends AbstractTestCase
{
    protected string $method = 'token';
    protected string $token = 'qwerty';

    /**
     * Test `getAuthMethod()`
     */
    public function testGetAuthMethod(): void
    {
        $auth = new Token($this->token);
        $this->assertEquals($this->method, $auth->getAuthMethod());
    }

    /**
     * Test `getToken()`
     */
    public function testGetToken(): void
    {
        $auth = new Token($this->token);
        $this->assertEquals($this->token, $auth->getToken());
    }
}
