<?php

class ClientTest extends TestCase
{
	private static Gotify\Endpoint\Client $client;

	private static int $clientId = 0;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$client = new Gotify\Endpoint\Client(
			self::$server->get(),
			self::$auth->get()
		);
	}

	/**
	 * Test creating a client
	 */
	public function testCreate(): void
	{
		$name = 'PHPUnit client';

		$client = self::$client->create(
			$name,
		);

		$this->assertIsObject($client);
		$this->assertObjectHasAttribute('id', $client);
		$this->assertObjectHasAttribute('name', $client);
		$this->assertObjectHasAttribute('token', $client);

		$this->assertEquals($name, $client->name);

		self::$clientId = $client->id;
	}

	/**
	 * Test getting all clients
	 * 
	 * @depends testCreate
	 */
	public function testGetAll(): void
	{
		$clients = self::$client->getAll();

		$this->assertIsArray($clients);

		if (count($clients) > 0) {
			$this->assertIsObject($clients[0]);
			$this->assertObjectHasAttribute('id', $clients[0]);
			$this->assertObjectHasAttribute('name', $clients[0]);
			$this->assertObjectHasAttribute('token', $clients[0]);
		}
	}

	/**
	 * Test updating a client
	 * 
	 * @depends testCreate
	 */
	public function testUpdate(): void
	{
		$name = 'New test client';

		$updated = self::$client->update(
			self::$clientId,
			$name
		);

		$this->assertIsObject($updated);
		$this->assertObjectHasAttribute('name', $updated);

		$this->assertEquals($name, $updated->name);
	}

	/**
	 * Test deleting a client
	 * 
	 * @depends testCreate
	 */
	public function testDelete(): void
	{
		$deleted = self::$client->delete(self::$clientId);
		$this->assertNull($deleted);
	}
}
