<?php

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Tests\AbstractTestCase;
use Gotify\Endpoint\Application;
use Gotify\Endpoint\ApplicationMessage;
use Gotify\Endpoint\AbstractEndpoint;

#[CoversClass(ApplicationMessage::class)]
#[UsesClass(Application::class)]
#[UsesClass(AbstractEndpoint::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
#[UsesClass(\Gotify\Auth::class)]
#[UsesClass(\Gotify\Auth\User::class)]
class ApplicationMessageTest extends AbstractTestCase
{
    private static ApplicationMessage $applicationMessage;

    private static int $appId = 0;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$applicationMessage = new ApplicationMessage(
            self::$server,
            self::$auth
        );

        // Create application to use when testing
        $application = new Application(
            self::$server,
            self::$auth
        );

        $app = $application->create('test app', '');
        self::$appId = $app->id;
    }

    public static function tearDownAfterClass(): void
    {
        // Delete test application
        $application = new Application(
            self::$server,
            self::$auth
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
        $this->assertObjectHasProperty('messages', $messages);
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
