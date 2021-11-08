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
	public function testCreate(): void
	{
		$name = 'test application';
		$description = 'A test application created via a unit test';

		$created = self::$application->create(
			$name,
			$description
		);

		$this->assertIsObject($created);
		$this->assertObjectHasAttribute('id', $created);
		$this->assertObjectHasAttribute('name', $created);
		$this->assertObjectHasAttribute('description', $created);

		$this->assertEquals($name, $created->name);
		$this->assertEquals($description, $created->description);

		self::$appId = $created->id;
	}

	/**
	 * Test getting all applications
	 * 
	 * @depends testCreate
	 */
	public function testGetAll(): void
	{
		$apps = self::$application->getAll();

		$this->assertIsArray($apps);

		if (count($apps) > 0) {
			$this->assertIsObject($apps[0]);
			$this->assertObjectHasAttribute('id', $apps[0]);
			$this->assertObjectHasAttribute('name', $apps[0]);
			$this->assertObjectHasAttribute('description', $apps[0]);
			$this->assertObjectHasAttribute('token', $apps[0]);
		}
	}

	/**
	 * Test updating an application
	 * 
	 * @depends testCreate
	 */
	public function testUpdate(): void
	{
		$name = 'test application';
		$description = 'A test application updated via a unit test';

		$updated = self::$application->update(
			self::$appId,
			$name,
			$description
		);

		$this->assertIsObject($updated);
		$this->assertObjectHasAttribute('name', $updated);
		$this->assertObjectHasAttribute('description', $updated);

		$this->assertEquals($name, $updated->name);
		$this->assertEquals($description, $updated->description);
	}

	/**
	 * Test uploading an image for the application
	 * 
	 * @depends testCreate
	 */
	public function testUploadImage(): void
	{
		$path = $this->getAppImagePath();
		$uploaded = self::$application->uploadImage(self::$appId, $path);

		$this->assertIsObject($uploaded);
		$this->assertObjectHasAttribute('image', $uploaded);
	}

	/**
	 * Test deleting an application
	 * 
	 * @depends testCreate
	 */
	public function testDelete(): void
	{
		$deleted = self::$application->delete(self::$appId);
		$this->assertNull($deleted);
	}
}
