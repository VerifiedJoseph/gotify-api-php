<?php

use Gotify\Endpoint\Application;

class ApplicationTest extends TestCase
{
    private static Application $application;

    private static int $appId = 0;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$application = new Application(
            self::$server,
            self::$auth
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
        $applications = self::$application->getAll();

        $this->assertIsObject($applications);
        $this->assertObjectHasAttribute('apps', $applications);

        if (count($applications->apps) > 0) {
            $this->assertIsObject($applications->apps[0]);

            $app = $applications->apps[0];

            $this->assertObjectHasAttribute('id', $app);
            $this->assertObjectHasAttribute('name', $app);
            $this->assertObjectHasAttribute('description', $app);
            $this->assertObjectHasAttribute('token', $app);
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

        $this->assertIsBool($deleted);
        $this->assertEquals(true, $deleted);
    }
}
