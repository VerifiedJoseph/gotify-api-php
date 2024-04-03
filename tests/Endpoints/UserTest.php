<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use Gotify\Endpoint\User;
use Gotify\Auth\User as Auth;

#[CoversClass(User::class)]
#[UsesClass(Gotify\Api::class)]
#[UsesClass(Gotify\Guzzle::class)]
#[UsesClass(Gotify\Json::class)]
#[UsesClass(Gotify\Server::class)]
#[UsesClass(Gotify\Auth::class)]
#[UsesClass(Gotify\Auth\User::class)]
class UserTest extends AbstractTestCase
{
    private static User $user;

    private static int $userId = 0;

    private static string $testUsername = 'test';
    private static string $testPassword = 'test';

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$user = new User(
            self::$server,
            self::$auth
        );
    }

    /**
     * Test getting the current user
     */
    public function testGetCurrent(): void
    {
        $current = self::$user->getCurrent();

        $this->assertIsObject($current);

        $this->assertObjectHasProperty('id', $current);
        $this->assertObjectHasProperty('name', $current);
        $this->assertObjectHasProperty('admin', $current);

        $this->assertEquals(self::$username, $current->name);
    }

    /**
     * Test getting a user
     */
    public function testGetUser(): void
    {
        $user = self::$user->getUser(self::$userId);

        $this->assertIsObject($user);
    }

    /**
     * Test getting all users
     */
    public function testGetAll(): void
    {
        $users = self::$user->getAll();

        $this->assertIsObject($users);
        $this->assertObjectHasProperty('users', $users);

        if (count($users->users) > 0) {
            $this->assertIsObject($users->users[0]);
        }
    }

    /**
     * Test creating a user
     */
    public function testCreate(): void
    {
        $created = self::$user->create(
            self::$testUsername,
            self::$testPassword,
            false // Admin status
        );

        $this->assertIsObject($created);
        self::$userId = $created->id;
    }

    /**
     * Test updating password for the current user
     *
     * @depends testCreate
     */
    public function testUpdatePassword(): void
    {
        // Login as test user
        $auth = new Auth(self::$testUsername, self::$testPassword);
        $user = new User(
            self::$server,
            $auth
        );

        $updated = $user->updatePassword('NewPassword');

        $this->assertIsBool($updated);
        $this->assertEquals(true, $updated);
    }

    /**
     * Test updating a user
     *
     * @depends testCreate
     */
    public function testUpdate(): void
    {
        $newTestUsername = 'test1';

        $updated = self::$user->update(
            self::$userId,
            $newTestUsername
        );

        $this->assertIsObject($updated);
        $this->assertObjectHasProperty('name', $updated);
        $this->assertObjectHasProperty('id', $updated);

        $this->assertEquals(self::$userId, $updated->id);
        $this->assertEquals($newTestUsername, $updated->name);
    }

    /**
     * Test deleting a user
     *
     * @depends testCreate
     */
    public function testDelete(): void
    {
        $deleted = self::$user->delete(self::$userId);

        $this->assertIsBool($deleted);
        $this->assertEquals(true, $deleted);
    }
}
