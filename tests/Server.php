<?php

class ServerTest extends TestCase
{
	/**
	 * Test server URI validator
	 */
	public function testServerUriValidator()
	{
		$this->expectException(Gotify\Exception\GotifyException::class);

		$server = new Gotify\Server('127.0.0.1');
	}
}
