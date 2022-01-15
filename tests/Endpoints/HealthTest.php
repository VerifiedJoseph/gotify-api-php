<?php

use Gotify\Endpoint\Health;

class HealthTest extends TestCase
{
	/**
	 * Test getting server health status
	 */
	public function testGet(): void
	{
		$health = new Health(
			self::$server->get()
		);

		$status = $health->get();

		$this->assertIsObject($status);
	}
}
