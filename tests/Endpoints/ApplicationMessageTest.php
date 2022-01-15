<?php

use Gotify\Endpoint\Application;
use Gotify\Endpoint\ApplicationMessage;

class ApplicationMessageTest extends TestCase
{
	private static ApplicationMessage $applicationMessage;

	private static int $appId = 0;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$applicationMessage = new ApplicationMessage(
			self::$server->get(),
			self::$auth->get()
		);

		// Create application to use when testing
		$application = new Application(
			self::$server->get(),
			self::$auth->get()
		);

		$app = $application->create('test app', '');
		self::$appId = $app->id;
	}

	public static function tearDownAfterClass(): void
	{
		// Delete test application
		$application = new Application(
			self::$server->get(),
			self::$auth->get()
		);

		$application->delete(self::$appId);
	}

	/**
	 * Test getting all messages for an application
	 */
	public function testGetAll(): void
	{
		$messages = self::$applicationMessage->getAll(self::$appId);

		$this->assertIsObject($messages);
		$this->assertObjectHasAttribute('messages', $messages);
	}

	/**
	 * Test deleting all messages for an application
	 */
	public function testDeleteAll(): void
	{
		$deleted = self::$applicationMessage->deleteAll(self::$appId);

		$this->assertIsBool($deleted);
		$this->assertEquals(true, $deleted);
	}
}
