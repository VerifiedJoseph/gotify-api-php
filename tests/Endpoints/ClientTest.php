<?php

use Gotify\Endpoint\Client;

class ClientTest extends TestCase
{
    private static Client $client;

    private static int $clientId = 0;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$client = new Client(
            self::$server,
            self::$auth
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
        $this->assertObjectHasProperty('id', $client);
        $this->assertObjectHasProperty('name', $client);
        $this->assertObjectHasProperty('token', $client);

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

        $this->assertIsObject($clients);
        $this->assertObjectHasProperty('clients', $clients);

        if (count($clients->clients) > 0) {
            $this->assertIsObject($clients->clients[0]);

            $client = $clients->clients[0];

            $this->assertObjectHasProperty('id', $client);
            $this->assertObjectHasProperty('name', $client);
            $this->assertObjectHasProperty('token', $client);
            $this->assertObjectHasProperty('lastUsed', $client);
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
        $this->assertObjectHasProperty('name', $updated);

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

        $this->assertIsBool($deleted);
        $this->assertEquals(true, $deleted);
    }
}
