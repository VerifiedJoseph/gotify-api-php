<?php

class ApplicationTest extends TestCase
{
	private static Gotify\Endpoint\Application $application;

	private static int $appId = 0;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		self::$application = new Gotify\Endpoint\Application(
			self::$server->get(),
			self::$auth->get()
		);
	}

	/**
	 * Test creating an application
	 */
	public function testCreate()
	{
		$created = self::$application->create(
			'test application',
			'A test application created via a unit test'
		);

		$this->assertIsObject($created);
		self::$appId = $created->id;
	}

	/**
	 * Test getting all applications 
	 */
	public function testGetAll()
	{
		$apps = self::$application->getAll();

		$this->assertIsArray($apps);

		if (count($apps) > 0) {
			$this->assertIsObject($apps[0]);
		}
	}

	/**
	 * Test updating an application
	 */
	public function testUpdate()
	{
		$updated = self::$application->update(
			self::$appId,
			'test application',
			'A test application updated via a unit test'
		);

		$this->assertIsObject($updated);
	}

	/**
	 * Test uploading an image for the application
	 */
	public function testUploadImage()
	{
		$path = $this->getAppImagePath();
		$uploaded = self::$application->uploadImage(self::$appId, $path);

		$this->assertIsObject($uploaded);
	}

	/**
	 * Test deleting an application
	 */
	public function testDelete()
	{
		$deleted = self::$application->delete(self::$appId);
		$this->assertNull($deleted);
	}
}
