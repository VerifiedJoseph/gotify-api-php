<?php

class VersionTest extends TestCase
{

	/**
	 * Test getting server version
	 */
	public function testGet()
	{
		$version = new Gotify\Endpoint\Version(
			self::$server->get()
		);

		$details = $version->get();

		$this->assertIsObject($details);
	}
}
