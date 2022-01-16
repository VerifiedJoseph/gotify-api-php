<?php

use Gotify\Server;
use Gotify\Exception\GotifyException;

class ServerTest extends TestCase
{
	/**
	 * Test server URI validator
	 * 
	 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
	 */
	public function testServerUriValidator(): void
	{
		$this->expectException(GotifyException::class);

		$server = new Server('127.0.0.1');
	}
}
