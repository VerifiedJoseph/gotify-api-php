<?php

use Gotify\Server;
use Gotify\Exception\GotifyException;

class ServerTest extends AbstractTestCase
{
    /**
     * Test server URI validator with missing forward slash
     */
    public function testServerUriValidatorWithMissingForwardSlash(): void
    {
        $server = new Server('https://example.com');
        $this->assertEquals('https://example.com/', $server->get());
    }

    /**
     * Test server URI validator with invalid URI
     */
    public function testServerUriValidatorWithInvalidUri(): void
    {
        $this->expectException(GotifyException::class);

        new Server('127.0.0.1');
    }
}
