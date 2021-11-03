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
	 * Test creating an client
	 */
	public function testCreate()
	{
		$client = self::$client->create(
			'test client',
		);

		$this->assertIsObject($client);
		self::$clientId = $client->id;
	}

	/**
	 * Test getting all clients
	 */
	public function testGetAll()
	{
		$clients = self::$client->getAll();

		$this->assertIsArray($clients);

		if (count($clients) > 0) {
			$this->assertIsObject($clients[0]);
		}
	}

	/**
	 * Test updating an client
	 */
	public function testUpdate()
	{
		$updated = self::$client->update(
			self::$clientId,
			'New test client',
		);

		$this->assertIsObject($updated);
	}

	/**
	 * Test deleting an application
	 */
	public function testDelete()
	{
		$deleted = self::$client->delete(self::$clientId);
		$this->assertNull($deleted);
	}
}