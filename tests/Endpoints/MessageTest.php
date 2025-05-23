<?php

declare(strict_types=1);

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\Depends;
use Tests\AbstractTestCase;
use Gotify\Endpoint\Message;
use Gotify\Endpoint\Application;
use Gotify\Endpoint\AbstractEndpoint;
use Gotify\Auth\Token;

#[CoversClass(Message::class)]
#[CoversClass(Application::class)]
#[CoversClass(Token::class)]
#[UsesClass(AbstractEndpoint::class)]
#[UsesClass(\Gotify\Auth\AbstractAuth::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
class MessageTest extends AbstractTestCase
{
    private static Message $message;

    private static string $appToken = '';
    private static int $appId = 0;

    private static int $messageId = 0;

    private static string $testTitle = 'Test message';
    private static string $testMessage = 'Hello World. This is a test message.';
    private static int $testPriority = 8;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$message = new Message(
            self::$server,
            self::$auth
        );

        // Create application to use when testing creating a message
        $application = new Application(
            self::$server,
            self::$auth
        );

        $app = $application->create('test app', '');
        self::$appId = $app->id;
        self::$appToken = $app->token;
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
     * Test creating a message
     */
    public function testCreate(): void
    {
        // Authenticate as test application via its token
        $auth = new Token(self::$appToken);
        $endpoint = new Message(
            self::$server,
            $auth
        );

        $message = $endpoint->create(
            self::$testTitle,
            self::$testMessage,
            self::$testPriority
        );

        $this->assertObjectHasProperty('id', $message);
        $this->assertObjectHasProperty('title', $message);
        $this->assertObjectHasProperty('message', $message);
        $this->assertObjectHasProperty('priority', $message);

        $this->assertEquals(self::$testTitle, $message->title);
        $this->assertEquals(self::$testMessage, $message->message);
        $this->assertEquals(self::$testPriority, $message->priority);

        self::$messageId = $message->id;
    }

    /**
     * Test creating a message with extras
     */
    #[Depends('testCreate')]
    public function testCreateWithExtras(): void
    {
        // Authenticate as test application via its token
        $auth = new Token(self::$appToken);
        $endpoint = new Message(
            self::$server,
            $auth
        );

        $extras = [
            'client::notification' => [
                'click' => ['url' => 'https://example.com']
            ]
        ];

        $message = $endpoint->create(
            self::$testTitle,
            self::$testMessage,
            self::$testPriority,
            $extras
        );

        $this->assertObjectHasProperty('extras', $message);
        $this->assertObjectHasProperty('client::notification', $message->extras);
        $this->assertObjectHasProperty('click', $message->extras->{'client::notification'});
        $this->assertObjectHasProperty('url', $message->extras->{'client::notification'}->click);

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

        $this->assertObjectHasProperty('messages', $messages);
    }

    /**
     * Test deleting a message
     */
    #[Depends('testCreate')]
    public function testDelete(): void
    {
        $deleted = self::$message->delete(self::$messageId);

        $this->assertTrue($deleted);
    }

    /**
     * Test deleting all messages
     */
    public function testDeleteAll(): void
    {
        $deleted = self::$message->deleteAll();

        $this->assertTrue($deleted);
    }
}
