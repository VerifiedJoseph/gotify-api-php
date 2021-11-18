<?php

class MessageTest extends TestCase
{
	private static Gotify\Endpoint\Message $message;

	private static string $appToken = '';
	private static int $appId = 0;

	private static int $messageId = 0;

	private static string $testTitle = 'Test message';
	private static string $testMessage = 'Hello World. This is a test message.';
	private static int $testPriority = 8;

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
		self::$appId = $app->id;
		self::$appToken = $app->token;
	}

	public static function tearDownAfterClass(): void
	{
		// Delete test application
		$application = new Gotify\Endpoint\Application(
			self::$server->get(),
			self::$auth->get()
		);

		$application->delete(self::$appId);
	}

	/**
	 * Test creating a message
	 */
	public function testCreate(): void
	{
		// Authenticate as test application via its token
		$auth = new Gotify\Auth\Token(self::$appToken);
		$endpoint = new Gotify\Endpoint\Message(
			self::$server->get(),
			$auth->get()
		);

		$message = $endpoint->create(
			self::$testTitle,
			self::$testMessage,
			self::$testPriority
		);

		$this->assertIsObject($message);
		$this->assertObjectHasAttribute('id', $message);
		$this->assertObjectHasAttribute('title', $message);
		$this->assertObjectHasAttribute('message', $message);
		$this->assertObjectHasAttribute('priority', $message);

		$this->assertEquals(self::$testTitle, $message->title);
		$this->assertEquals(self::$testMessage, $message->message);
		$this->assertEquals(self::$testPriority, $message->priority);

		self::$messageId = $message->id;
	}

	/**
	 * Test creating a message with extras
	 *
	 * @depends testCreate
	 */
	public function testCreateWithExtras(): void
	{
		// Authenticate as test application via its token
		$auth = new Gotify\Auth\Token(self::$appToken);
		$endpoint = new Gotify\Endpoint\Message(
			self::$server->get(),
			$auth->get()
		);

		$extras = array(
			'client::notification' => array(
				'click' => array('url' => 'https://example.com')
			)
		);

		$message = $endpoint->create(
			self::$testTitle,
			self::$testMessage,
			self::$testPriority,
			$extras
		);

		$this->assertIsObject($message);
		$this->assertObjectHasAttribute('extras', $message);
		$this->assertObjectHasAttribute('client::notification', $message->extras);
		$this->assertObjectHasAttribute('click', $message->extras->{'client::notification'});
		$this->assertObjectHasAttribute('url', $message->extras->{'client::notification'}->click);

		$this->assertEquals(
			$extras['client::notification']['click']['url'],
			$message->extras->{'client::notification'}->click->url
		);
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

		$this->assertIsBool($deleted);
		$this->assertEquals(true, $deleted);
	}

	/**
	 * Test deleting all messages
	 */
	public function testDeleteAll(): void
	{
		$deleted = self::$message->deleteAll();

		$this->assertIsBool($deleted);
		$this->assertEquals(true, $deleted);
	}
}
