<?php

class HealthTest extends TestCase
{
	/**
	 * Test getting server health status
	 */
	public function testGet()
	{
		$health = new Gotify\Endpoint\Health(
			self::$server->get()
		);

		$status = $health->get();

		$this->assertIsObject($status);
	}
}
