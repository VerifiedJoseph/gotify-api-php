<?php

class MessageTest extends TestCase
{
	private static Gotify\Endpoint\Message $message;

	private static string $appToken = '';
	private static int $messageId = 0;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$message = new Gotify\Endpoint\Message(
			self::$server->get(),
			self::$auth->get()
		);

		// Create application to use when testing creating a message
		$application = new Gotify\Endpoint\Application(
			self::$server->get(),
			self::$auth->get()
		);

		$app = $application->create('test app', '');
		self::$appToken = $app->token;
	}

	/**
	 * Test creating a message
	 */
	public function testCreate(): void
	{
		// Authenticate as test application via its token
		$auth = new Gotify\Auth\Token(self::$appToken);
		$message = new Gotify\Endpoint\Message(
			self::$server->get(),
			$auth->get()
		);

		$created = $message->create(
			'Test message',
			'Hello World. This is a test message.',
			8 // Message priority
		);

		$this->assertIsObject($created);
		self::$messageId = $created->id;
	}

	/**
	 * Test getting all messages
	 */
	public function testGetAll(): void
	{
		$messages = self::$message->getAll();

		$this->assertIsObject($messages);
		$this->assertObjectHasAttribute('messages', $messages);
	}

	/**
	 * Test deleting a message
	 * 
	 * @depends testCreate
	 */
	public function testDelete(): void
	{
		$deleted = self::$message->delete(self::$messageId);
		$this->assertNull($deleted);
	}

	/**
	 * Test deleting all messages
	 */
	public function testDeleteAll(): void
	{
		$deleted = self::$message->deleteAll();
		$this->assertNull($deleted);
	}
}
